# 🎓 Student Productivity Dashboard

A sleek, lightweight web application designed to help students manage tasks, stay focused, and organize their academic life. Styled with a modern **LMS (Learning Management System)** aesthetic, this dashboard is built for simplicity and customization.

---

![](https://media.tenor.com/dToZwOQOtBwAAAAi/strinova-kokona.gif)

## 🚀 For Pros (TL;DR)

A simple web project for task reminders styled like an LMS web app or desktop application. Customize the appearance/style as you like—build on your own branch via fork or clone.

> **IMPORTANT**
> New to GitHub? Please follow this beginner-friendly guide in exact sequence for any OS.

---

## 📑 Table of Contents

* [✨ Features](#-features)
* [1. Install Git](#1-install-git)
* [2. Fork & Clone](#2-fork--clone)
* [3. Syncing with Upstream](#3-syncing-with-upstream)
* [4. Making Changes](#4-making-changes)
* [5. Sharing Your Work](#5-sharing-your-work)
* [🚀 Quick Command Reference](#-quick-command-reference)

---

## ✨ Features

* **Task Reminders** — Never miss a deadline.
* **LMS Interface** — Familiar, clean, and distraction-free design.
* **Local Development** — Easy to run, no complex servers required.
* **Customizable** — Fork it, style it, and make it your own.

---

## 1. Install Git

Before you start, you need Git installed on your computer.

### Linux

```bash
# Fedora
sudo dnf install git-all

# Ubuntu / Debian
sudo apt install git

# Arch Linux
sudo pacman -S git
```

### Windows & macOS

1. Download Git from the official site: [https://git-scm.com/downloads](https://git-scm.com/downloads)
2. Verify installation:

```bash
git --version
```

3. Configure Git (replace with your info):

```bash
git config --global user.name "Your Name"
git config --global user.email "your@email.com"
```

---

## 2. Fork & Clone

**Forking** creates a copy of this project on your GitHub account. **Cloning** downloads it to your computer.

1. Navigate to the original repository:
   [https://github.com/muhammadrossiramadhan/Student-Productivity-Dashboard](https://github.com/muhammadrossiramadhan/Student-Productivity-Dashboard)
2. Click the **Fork** button (top-right).
3. Clone your fork:

```bash
# Replace YOUR-USERNAME with your GitHub username
git clone https://github.com/YOUR-USERNAME/Student-Productivity-Dashboard.git
cd Student-Productivity-Dashboard
```

> **NOTE**
> VS Code users can open the project instantly:

```bash
code .
```

Sign in via Command Palette if prompted (`Ctrl+Shift+P` / `Cmd+Shift+P`).

---

## 3. Syncing with Upstream

To receive updates from the original repository:

```bash
git remote add upstream https://github.com/muhammadrossiramadhan/Student-Productivity-Dashboard.git
```

---

## 4. Making Changes

⚠️ **Never edit the `main` branch directly.** Always use a feature branch.

Create and switch to a new branch:

```bash
git checkout -b your-feature-name
```

Examples:

* `task-reminders`
* `pomodoro-timer`
* `dark-theme`

Edit files and test locally by opening `index.html` in your browser.

Stage and commit changes:

```bash
git add .
git commit -m "Add your feature description here"
```

> **WARNING**
> Use clear, descriptive commit messages and always test before committing.

---

## 5. Sharing Your Work 9 ( opsional )

Push your branch to GitHub:

```bash
git push -u origin your-feature-name
```

Then:

1. Go to your GitHub repository.
2. Click **Compare & pull request**.
3. Describe your changes and submit the PR.

---

## 🚀 Quick Command Reference

| Action        | Command                   | When to Use            |
| ------------- | ------------------------- | ---------------------- |
| Check status  | `git status`              | Before & after changes |
| Fetch updates | `git fetch upstream`      | Check upstream updates |
| Sync main     | `git merge upstream/main` | Update local main      |
| Push code     | `git push`                | Upload commits         |

---

## 💡 Pro Tips

* **Deployment**: Use **GitHub Pages** (Settings → Pages) to host your dashboard for free.
* **Stay Updated**: Regularly sync your fork with upstream.
* **Extension Ideas**:

  * Save tasks with `localStorage`
  * Browser notifications
  * Progress charts & analytics

---

Built for students, by students. **Build your version. 🚀**
