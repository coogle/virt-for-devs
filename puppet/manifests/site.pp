info("Configuring '${::fqdn}' using environment '${::environment}'")

# Fix for Puppet working with Vagrants
group { 'puppet': ensure => 'present', }

# Setup global PATH variable
Exec { logoutput => true, path => [
    '/usr/local/bin',
    '/opt/local/bin',
    '/usr/bin',
    '/usr/sbin',
    '/bin',
    '/sbin',
    '/usr/local/zend/bin',
], }

if $environment == 'development' {
    $site_domain = 'virtfordevs.example.com'
} else {
    if $environment == 'staging' {
        $site_domain = 'virtfordevs.example.com'
    } else {
        $site_domain = 'virtfordevs.example.com'
    }
}

import 'nodes/*.pp'
import 'global_defines.pp'
