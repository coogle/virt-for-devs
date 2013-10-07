class virtfordevs::database {
  
  class { 'mysql' :
     root_password => 'password'
  }

  file { "/tmp/virtfordevs-create.sql":
    source => "puppet:///modules/virtfordevs/database/create.sql"
  }
  
  file { "/tmp/virtfordevs-basedata.sql" :
    source => "puppet:///modules/virtfordevs/database/basedata.sql"
  }
  
  if $environment == 'development' {
	  mysql::user { "virtfordevs_user-$environment" :
	    mysql_user => 'virtfordevs',
	    mysql_password => 'password',
	    mysql_host => 'localhost'
	  }
	  
	  mysql::grant { 'virtfordevs' :
      mysql_privileges => 'ALL',
      mysql_password => 'password',
      mysql_db => 'virtfordevs',
      mysql_user => 'virtfordevs',
      mysql_host => 'localhost',
      require => [ "Mysql::User[virtfordevs_user-$environment]" ]
    }
   
    mysql::queryfile { 'virtfordevs-create-sql' :
      mysql_file => '/tmp/virtfordevs-create.sql',
      mysql_user => 'virtfordevs',
      mysql_password => 'password',
      mysql_db => 'virtfordevs',
      require => [ File['/tmp/virtfordevs-create.sql'], "Mysql::Grant[virtfordevs]" ]
    }
    
    mysql::queryfile { 'virtfordevs-basedata-sql': 
      mysql_file => '/tmp/virtfordevs-basedata.sql',
      mysql_user => 'virtfordevs',
      mysql_password => 'password',
      mysql_db => 'virtfordevs',
      require => [ File['/tmp/virtfordevs-basedata.sql'], "Mysql::Queryfile[virtfordevs-create-sql]"]
    }  
  } 	
}
