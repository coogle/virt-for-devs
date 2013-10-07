# Usage: ENV=staging vagrant up
environment = "development"
if ENV["ENV"] && ENV["ENV"] != ''
    environment = ENV["ENV"].downcase
end

# Usage: ROLE=webserver vagrant up
role = "webserver"
if ENV["ROLE"] && ENV["ROLE"] != ''
    role = ENV["ROLE"].downcase
end

Vagrant.configure("2") do |config|

    # Turn on SSH agent forwarding
    config.ssh.forward_agent = true

    #
    # Development
    if environment == 'development'
        # The hostname the machine should have.
        config.vm.hostname = "virtfordevs.example.com"

        # Every Vagrant virtual environment requires a box to build off of.
        config.vm.box = "precise64"

        # The url from where the 'config.vm.box' box will be fetched if it
        # doesn't already exist on the user's system.
        config.vm.box_url = "http://files.vagrantup.com/precise64.box"

        # Create a forwarded port mapping which allows access to a specific port
        # within the machine from a port on the host machine. In the example below,
        # accessing "localhost:8080" will access port 80 on the guest machine.
        config.vm.network :forwarded_port, guest: 80,    host: 80    # apache http
        config.vm.network :forwarded_port, guest: 3306,  host: 3306  # mysql
        config.vm.network :forwarded_port, guest: 10081, host: 10081 # zend http
        config.vm.network :forwarded_port, guest: 10082, host: 10082 # zend https
        config.vm.network :forwarded_port, guest: 27017, host: 27017 # mongodb

        # Create a private network, which allows host-only access to the machine
        # using a specific IP.
        config.vm.network :private_network, ip: "192.168.42.42"

        #
        # Puppet
        config.vm.provision :puppet do |puppet|
            # Enable provisioning with Puppet stand alone.  Puppet manifests
            # are contained in a directory path relative to this Vagrantfile.
            # You will need to create the manifests directory and a manifest in
            # the file base.pp in the manifests_path directory.
            puppet.options        = "--verbose --debug"
            puppet.manifests_path = "puppet/manifests"
            puppet.module_path    = "puppet/modules"
            puppet.manifest_file  = "site.pp"
            puppet.facter         = {
                "vagrant"     => true,
                "environment" => environment,
                "role"        => "local",
            }
        end

        # VirtualBox
        config.vm.provider :virtualbox do |vb, override|
            # Boot with headless mode
            vb.gui = false

            # Use VBoxManage to customize the VM. For example to change memory to 512:
            vb.customize ["modifyvm", :id, "--memory", 512]

            # Enable symbolic link creation in VirtualBox
            vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/vagrant-root", "1"]

            # Use NFS for shared project directory (ignored on Windows)
            # config.vm.synced_folder ".", "/vagrant", :nfs => true

            # Set permissions for shared directory
            # config.vm.synced_folder ".", "/vagrant", :extra => "dmode=775,fmode=664"
        end
    end

    #
    # Staging
    if environment == 'staging'
        # Every Vagrant virtual environment requires a box to build off of.
        config.vm.box = "dummy"

        # Disable automatic syncing of project directory
        # config.vm.synced_folder ".", "/vagrant", disabled: true

        # Amazon Web Services
        config.vm.provider :aws do |aws, override|
            aws.access_key_id     = "KEYID"
            aws.secret_access_key = "SECRETACCESSSKEY"
            aws.instance_type     = "t1.micro"
            aws.region            = "us-east-1"
            aws.security_groups   = [ role ]
            aws.tags              = {
                "vagrant"     => "true",
                "environment" => environment,
                "role"        => role,
            }

            # us-east-1
            aws.region_config "us-east-1" do |region|
                region.ami          = "ami-154b247c"
                region.keypair_name = "ec2-key-id"
            end

            override.ssh.username         = "ubuntu"
            override.ssh.private_key_path = "~/.ssh/ec2-key-id.pem"
        end

        # Puppet
        config.vm.provision :puppet do |puppet|
            puppet.options        = "--verbose --debug"
            puppet.manifests_path = "puppet/manifests"
            puppet.module_path    = "puppet/modules"
            puppet.manifest_file  = "site.pp"
            puppet.facter         = {
                "vagrant"     => true,
                "environment" => environment,
                "role"        => role,
            }
        end
    end

    #
    # Production
    if environment == 'production'
        # For now, we will avoid creating production instances via Vagrant
    end
end
