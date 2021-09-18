# Vagrant example
This repository is a basic example of Vagrant witch puppet and ansible configurations

# Requirements
- vagrant: `2.2.18`
________________
### Generate ssh key
```shell
$ ./generate-key.sh
```

_____________________

### Simplified start
```shell
$ ./generate-key.sh && \
  vagrant up && \
  vagrant halt ansible && \
  vagrant destroy -f ansible
```

### start vms
```shell
$ vagrant up
```

### stop vms
```shell
$ vagrant halt
```

### reload vms
> ... (sometimes doesn't work)
```shell
$ vagrant reload
```

### destroy vms
```shell
# you can 'vagrant destroy -f' to forces vm destruction
$ vagrant destroy
```

> you run commands individually witch `vagrant up mysql` instead run for all vms



_____________

### global commands

```shell
# all vms status
$ vagrant global-status

# clean cache
$ vagrant global-status --prune
```