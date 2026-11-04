# Custom Elementor Header & Footer Injector

A lightweight, performance-focused WordPress plugin that allows developers and site administrators to inject custom CSS, JavaScript, and HTML tracking code directly into header (`wp_head`) and footer (`wp_footer`) hooks without modifying theme templates or adding site bloat.

---

## 🚀 Features

* **High Performance:** Lightweight design with zero third-party framework overhead, preserving page load times and Core Web Vitals.
* **Header & Footer Hooks:** Easily insert custom scripts, styles, meta tags, and analytics tracking codes into `wp_head` or `wp_footer`.
* **Clean Code Execution:** Safe and organized code injection without modifying template files.
* **Theme Independent:** Code snippets remain active even when switching themes.

---

## 📁 Project Structure

```text
header-footer-injector/
│
└── custom-header-injector.php    # Main plugin file & code injection logic
