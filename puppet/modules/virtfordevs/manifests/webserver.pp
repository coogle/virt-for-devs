class virtfordevs::webserver {
    include zendserver
    include apache::ssl
    
    $approot = "/vagrant"
    $docroot = "${approot}/public"

    exec { "enable-apache2-ssl" : 
      command => 'a2enmod ssl',
      notify => Service['apache'],
      require => Package['apache']
    }
    
    # Disable the default (catch-all) vhost
    exec { "disable default virtual host from ${name}":
        command => "a2dissite default",
        onlyif  => "test -L ${apache::params::config_dir}/sites-enabled/000-default",
        notify  => Service['apache'],
        require => Package['apache'],
    }

    file { "/usr/local/bin/pear" : 
      target => '/usr/local/zend/bin/pear',
      ensure => 'link',
      require => [ Class['zendserver'] ]
    }
    
    file { "/usr/local/zend/etc/conf.d/curl.ini" :
      ensure => absent,
      require => [ Class['zendserver'] ],
      notify => Service['apache']
    }
    
    file { "/usr/local/zend/etc/php.ini" :
      source => 'puppet:///modules/virtfordevs/php/php.ini',
      owner => root,
      group => zend,
      mode => 644,
      require => [ Class['zendserver'] ],
      notify => Service['apache']
    }
    
    exec { "install-pear-db" :
      command => 'pear install DB',
      unless => 'pear info DB',
      require => [ File['/usr/local/bin/pear'] ]
    }
    
    # Enable our vhost
    apache::vhost { "${site_domain}":
        docroot  => "${docroot}",
        ssl      => true,
        priority => '000',
        template => 'virtfordevs/apache/virtualhost/vhost.conf.erb',
        require => [ Exec['enable-apache2-ssl'] ]
    }

    # Install Composer
    class { 'composer':
        target_dir   => '/usr/local/bin',
        command_name => 'composer',
        auto_update  => false,
        user         => 'root'
    }

    exec { 'composer self-update':
        command => "${composer::composer_command_name} self-update",
        user    => $composer::composer_user,
        require => [ Exec['composer-fix-permissions'], File['/usr/local/bin/php'], Class['composer'] ]
    }

}
