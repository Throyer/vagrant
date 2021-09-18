#!/bin/bash
ssh-keygen -t rsa -f id_ubuntu -q -N "" && mv id_ubuntu.pub configurations