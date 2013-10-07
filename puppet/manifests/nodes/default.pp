node default {
    include apt
    include git
    include vim
    include stdlib
    include virtfordevs::database
    include virtfordevs::webserver
    include virtfordevs::codebase

    sysctl::value { 'fs.file-max':          value => '100000' }
    sysctl::value { 'vm.overcommit_memory': value => '1' }

    exec { "apt-get clean" :
      command => "/usr/bin/apt-get clean"
    }
    
    exec { "apt-update":
      command => "/usr/bin/apt-get update",
      require => [ Exec['apt-get clean'] ]
    }
    
    Exec["apt-update"] -> Package <| |>
}
