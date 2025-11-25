#!/bin/bash
uname -a
lsb_release -a
echo "Kernel: $(uname -r)"
echo "CPU: $(lscpu | grep 'Model name')"
echo "Memory:"
free -h
echo "Disk:"
df -h