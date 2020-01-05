#!/bin/bash


key=$1
if [ "$key" == "alt" ]; then
echo "connecting to domain.com. Please wait..."
sshpass -p "password" ssh -o StrictHostKeyChecking=no username@domain.com 'bash -s' < /path/deploysetup.sh
else
echo "NO DATA FOUND"
fi
