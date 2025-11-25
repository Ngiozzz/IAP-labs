# 🐧 Lab 1 — Linux Installatio

## ✔️ Student: <Glenn Ngio>
## ✔️ Lab: Linux Installation / Usage Evidence

---

## 1. Overview
This lab demonstrates that I use Linux as my primary development environment.  
All commands and outputs shown below were executed directly on my Linux system.

---

## 2. Linux Distribution
I am currently using:

- **Distro:** Ubuntu 22.04.5 LTS 
- **Architecture:** 64-bit
- **Environment:** Installed on bare-metal / dual-boot / VM (choose one)

---

## 3. System Verification Commands

### ✔️ Kernel & System Info
```bash
uname -a
✔️ Distribution Info
lsb_release -a

✔️ CPU Info
lscpu | grep "Model name"

✔️ Memory Info
free -h

✔️ Disk Usage
df -h