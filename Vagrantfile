
$script_add_ssh_key = <<-SCRIPT
  cat /vagrant/configurations/id_ubuntu.pub >> .ssh/authorized_keys
SCRIPT

Vagrant.configure("2") do |config|
  # -- BASE LINUX DISTRO TO VMS
  config.vm.box = "ubuntu/bionic64"

  config.vm.provider "virtualbox" do |virtualbox|
    virtualbox.memory = 256
    virtualbox.cpus = 1
  end

  config.vm.define "mysql" do |mysql|
    # -- PRIVATE NETWORK EXAMPLES
    # mysql.vm.network "private_network", ip: "192.168.1.11"
    # mysql.vm.network "private_network", type: "dhcp"
    
    # -- PUBLIC NETWORK EXAMPLES
    # mysql.vm.network "public_network", ip: "192.168.0.11"
    # mysql.vm.network "public_network"

    # -- SHARED FOLDERS CONFIG
    # mysql.vm.synced_folder "./shared", "/shared"
    # mysql.vm.synced_folder ".", "/vagrant", disabled: true

    mysql.vm.provider "virtualbox" do |virtualbox|
      virtualbox.name = "ubuntu_mysql"
      virtualbox.memory = 1024
      virtualbox.cpus = 2
    end

    mysql.vm.network "forwarded_port", guest: 3306, host: 3306

    mysql.vm.network "private_network", ip: "192.168.1.11"

    mysql.vm.provision "shell", inline: $script_add_ssh_key
  end

  # -- APACHE/PHP WITCH puppet EXAMPLE
  config.vm.define "apache" do |apache|

    apache.vm.provider "virtualbox" do |virtualbox|
      virtualbox.name = "ubuntu_apache"
      virtualbox.memory = 1024
      virtualbox.cpus = 2
    end

    apache.vm.network "forwarded_port", guest: 8080, host: 8080

    apache.vm.network "private_network", ip: "192.168.1.12"

    apache.vm.provision "shell", inline: $script_add_ssh_key
    
    apache.vm.provision "shell",
      inline: "apt-get update && apt-get install -y puppet"

    apache.vm.provision "puppet" do |puppet|
      puppet.manifests_path = "./configurations/manifests"
      puppet.manifest_file = "apache.pp"
    end 
  end

  # -- VM WITCH ansible TO CONFIGURE mysql BY ssh EXAMPLE
  config.vm.define "ansible" do |ansible|
    ansible.vm.network "private_network", ip: "192.168.1.10"

    ansible.vm.provision "shell", inline: $script_add_ssh_key

    # -- ADD PRIVATE KEY
    ansible.vm.provision "shell",
      inline: "cp /vagrant/id_ubuntu /home/vagrant && \
               chmod 600 /home/vagrant/id_ubuntu && \
               chown vagrant:vagrant /home/vagrant/id_ubuntu"
    
    # -- INSTALL ansible
    ansible.vm.provision "shell",
      inline: "apt-get update && \
               apt-get install -y software-properties-common && \
               apt-add-repository --yes --update ppa:ansible/ansible && \
               apt-get install -y ansible"

    # -- DO REMOTE ansible CONFIGURATION
    ansible.vm.provision "shell",
      inline: "ansible-playbook -i \
               /vagrant/configurations/ansible/hosts \
               /vagrant/configurations/ansible/playbook.yml"
  end

  # config.vm.define "docker" do |docker|
  #   docker.vm.provider "virtualbox" do |virtualbox|
  #     virtualbox.name = "ubuntu_docker"
  #     virtualbox.memory = 1024
  #     virtualbox.cpus = 2
  #   end
  # 
  #   docker.vm.provision "shell",
  #     inline: "apt-get update && \
  #              apt-get install -y docker.io && \
  #              apt-get install docker-compose -y && \
  #              usermod -aG docker vagrant && \
  #              systemctl enable docker.service && \
  #              systemctl enable containerd.service"
  # end
end
