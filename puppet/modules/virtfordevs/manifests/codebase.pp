class virtfordevs::codebase {

   info("Deploying Codebase for environment $environment")

   if $environment != 'development' {
 	# Deploy to other systems
   } else {
      exec { 'composer install-development':
          command => "${composer::composer_command_name} install",
          cwd     => "/vagrant",
          require => [
              Exec['composer self-update'],
              Class['git']
          ]
      }
     info("Environment is development, Vagrant takes care of this for us.")
   }

   file { '/vagrant/config/autoload/local.php' :
      source => "puppet:///modules/virtfordevs/config/$environment/local.php",
      require => [ Exec["composer install-$environment"] ]
   }
}
