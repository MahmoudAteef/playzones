// ================================================================
// PWA Manager - Professional PWA System
// مدير PWA الاحترافي لإدارة التثبيت والاتصال
// ================================================================

class PWAManager {
  constructor() {
    this.deferredPrompt = null;
    this.isInstalled = false;
    this.isOnline = navigator.onLine;
    this.updateNotificationSettings = null;
    this.updateNotificationTimer = null;
    this.init();
  }

  // ================================================================
  // Initialize PWA Manager
  // ================================================================
  init() {
    // Read PWA enabled flag injected from server if available
    this.pwaEnabled =
      window.__PWA_ENABLED__ !== undefined ? !!window.__PWA_ENABLED__ : true;

    // If disabled, cleanup and stop
    if (!this.pwaEnabled) {
      this.unregisterServiceWorker();
      this.hideInstallButton();
      return;
    }

    // Check if PWA is already installed
    this.checkInstallation();

    // Listen for beforeinstallprompt event
    window.addEventListener("beforeinstallprompt", (e) => {
      e.preventDefault();
      this.deferredPrompt = e;
      if (this.pwaEnabled) {
        this.showInstallButton();
      }
    });

    // Also try to detect if install is possible even without beforeinstallprompt
    // This helps in cases where browser doesn't fire the event
    this.checkInstallEligibility();

    // Listen for app installed event
    window.addEventListener("appinstalled", () => {
      this.isInstalled = true;
      this.hideInstallButton();
      this.showInstallSuccessMessage();
    });

    // Monitor online/offline status
    window.addEventListener("online", () => this.handleOnline());
    window.addEventListener("offline", () => this.handleOffline());

    // Check for updates periodically
    this.checkForUpdates();

    // Register service worker
    this.registerServiceWorker();

    // Load update notification settings and start periodic notifications
    this.loadUpdateNotificationSettings();
  }

  // ================================================================
  // Register Service Worker
  // ================================================================
  async registerServiceWorker() {
    if ("serviceWorker" in navigator) {
      try {
        // Add cache-busting version
        const registration = await navigator.serviceWorker.register(
          "/sw.js?v=" + Date.now(),
          {
            scope: "/",
          }
        );

        // Check for updates immediately
        await registration.update();

        // Check for updates every 5 minutes
        setInterval(() => {
          registration.update();
        }, 5 * 60 * 1000);

        // Listen for updates
        registration.addEventListener("updatefound", () => {
          // Old notification disabled - using custom notification system instead
          // this.notifyUserOfUpdate();
        });
      } catch (error) {
        // Silent fail
      }
    }
  }

  // ================================================================
  // Unregister Service Worker (when PWA disabled)
  // ================================================================
  async unregisterServiceWorker() {
    if (!("serviceWorker" in navigator)) return;
    try {
      const regs = await navigator.serviceWorker.getRegistrations();
      for (const reg of regs) {
        // Only unregister our scope
        const expectedScope = window.location.origin + "/";
        if (reg.scope && reg.scope === expectedScope) {
          await reg.unregister();
        }
      }

      // Clear all related caches
      const cacheNames = await caches.keys();
      for (const cacheName of cacheNames) {
        if (
          cacheName.includes("ps-saass") ||
          cacheName.includes("pwa") ||
          cacheName.includes("v1")
        ) {
          await caches.delete(cacheName);
        }
      }

      // Hide install UI
      this.hideInstallButton();
    } catch (e) {
      // Silent fail
    }
  }

  // ================================================================
  // Check if PWA is installed
  // ================================================================
  checkInstallation() {
    // Check if running in standalone mode (installed)
    if (
      window.matchMedia("(display-mode: standalone)").matches ||
      window.navigator.standalone ||
      document.referrer.includes("android-app://")
    ) {
      this.isInstalled = true;
      this.hideInstallButton();
    }
  }

  // ================================================================
  // Check Install Eligibility
  // ================================================================
  checkInstallEligibility() {
    // Check if manifest exists
    const manifestLink = document.querySelector('link[rel="manifest"]');
    if (manifestLink) {
      // Try to show button even without beforeinstallprompt if conditions are met
      setTimeout(() => {
        if (this.pwaEnabled && !this.isInstalled && !this.deferredPrompt) {
          // Check if we should show the button anyway
          // Don't auto-show, but log for debugging
        }
      }, 2000);
    }
  }

  // ================================================================
  // Show Install Button
  // ================================================================
  showInstallButton() {
    let installButton = document.getElementById("pwa-install-btn");
    if (!installButton) {
      return;
    }

    if (!this.isInstalled && this.deferredPrompt) {
      installButton.style.display = "flex";
      installButton.classList.remove("hidden"); // Remove hidden class
      installButton.classList.add("animate-pulse");
    }
  }

  // ================================================================
  // Hide Install Button
  // ================================================================
  hideInstallButton() {
    const installButton = document.getElementById("pwa-install-btn");
    if (installButton) {
      installButton.style.display = "none";
      installButton.classList.add("hidden");
    }
  }

  // ================================================================
  // Install PWA
  // ================================================================
  async install() {
    if (!this.deferredPrompt) {
      return;
    }

    try {
      // Show the install prompt
      this.deferredPrompt.prompt();

      // Wait for the user to respond
      const { outcome } = await this.deferredPrompt.userChoice;

      if (outcome === "accepted") {
        this.isInstalled = true;
        this.hideInstallButton();
        this.showInstallSuccessMessage();
      }

      // Clear the prompt
      this.deferredPrompt = null;
    } catch (error) {
      // Silent fail
    }
  }

  // ================================================================
  // Handle Online
  // ================================================================
  handleOnline() {
    this.isOnline = true;

    // Show online notification (small toast only)
    this.showNotification("تم استعادة الاتصال بالإنترنت", "success");

    // Sync data if needed
    this.syncData();
  }

  // ================================================================
  // Handle Offline
  // ================================================================
  handleOffline() {
    this.isOnline = false;
    // Removed big offline card - browser shows its own notification
  }

  // ================================================================
  // Show Install Success Message
  // ================================================================
  showInstallSuccessMessage() {
    this.showNotification(
      "تم تثبيت التطبيق بنجاح! يمكنك استخدامه الآن بدون متصفح.",
      "success"
    );
  }

  // ================================================================
  // Show Notification
  // ================================================================
  showNotification(message, type = "info") {
    // Use SweetAlert2 if available
    if (typeof Swal !== "undefined") {
      Swal.fire({
        icon: type === "success" ? "success" : "info",
        title: type === "success" ? "نجاح" : "تنبيه",
        text: message,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
      });
    }
  }

  // ================================================================
  // Check for Updates
  // ================================================================
  async checkForUpdates() {
    try {
      const registration = await navigator.serviceWorker.ready;
      const response = await fetch("/sw.js", { cache: "no-store" });
      const newVersion = await response.text();

      // Simple version check (can be enhanced)

      // If new version available, ask user to reload
      registration.update();
    } catch (error) {
      // Silent fail
    }
  }

  // ================================================================
  // Notify User of Update
  // ================================================================
  notifyUserOfUpdate() {
    if (typeof Swal !== "undefined") {
      Swal.fire({
        title: "تحديث متاح",
        text: "يوجد نسخة جديدة من التطبيق. هل تريد تحديثه الآن؟",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "تحديث",
        cancelButtonText: "لاحقاً",
        confirmButtonColor: "#667eea",
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.reload();
        }
      });
    } else {
      if (confirm("يوجد تحديث متاح. هل تريد تحديث التطبيق الآن؟")) {
        window.location.reload();
      }
    }
  }

  // ================================================================
  // Sync Data
  // ================================================================
  async syncData() {
    try {
      // Implement data synchronization logic here
      // Example: Sync any pending changes
      // This can be customized based on your needs
    } catch (error) {
      // Silent fail
    }
  }

  // ================================================================
  // Load Update Notification Settings (Customizable from Admin)
  // ================================================================
  async loadUpdateNotificationSettings() {
    try {
      const response = await fetch("/api/pwa-notification-settings.php");

      // Check if response is ok
      if (!response.ok) {
        throw new Error(`HTTP ${response.status}`);
      }

      const data = await response.json();

      if (data.success) {
        this.updateNotificationSettings = data.settings;
      } else {
        // Use fallback settings from error response
        this.updateNotificationSettings = data.settings || {
          enabled: false,
          title: "تحديث متاح",
          message: "يوجد نسخة جديدة من التطبيق. هل تريد تحديثه الآن؟",
          interval: 60,
          confirmText: "تحديث",
          cancelText: "لاحقاً",
        };
      }

      // Start periodic notifications if enabled
      if (
        this.updateNotificationSettings &&
        this.updateNotificationSettings.enabled
      ) {
        this.startPeriodicUpdateNotification();
      }
    } catch (error) {
      // Silently fail and use default disabled settings
      this.updateNotificationSettings = {
        enabled: false,
        title: "تحديث متاح",
        message: "يوجد نسخة جديدة من التطبيق. هل تريد تحديثه الآن؟",
        interval: 60,
        confirmText: "تحديث",
        cancelText: "لاحقاً",
      };
    }
  }

  // ================================================================
  // Start Periodic Update Notification
  // ================================================================
  startPeriodicUpdateNotification() {
    if (
      !this.updateNotificationSettings ||
      !this.updateNotificationSettings.enabled
    ) {
      return;
    }

    // Clear any existing timer
    if (this.updateNotificationTimer) {
      clearInterval(this.updateNotificationTimer);
    }

    const intervalMs = this.updateNotificationSettings.interval * 60 * 1000;

    // Check if we should show notification based on last shown time
    this.checkAndShowNotification();

    // Then start the periodic interval
    this.updateNotificationTimer = setInterval(() => {
      this.checkAndShowNotification();
    }, 60000); // Check every minute
  }

  // ================================================================
  // Check and Show Notification Based on Last Shown Time
  // ================================================================
  checkAndShowNotification() {
    if (
      !this.updateNotificationSettings ||
      !this.updateNotificationSettings.enabled
    ) {
      return;
    }

    try {
      const lastShown = localStorage.getItem("pwa_last_notification_time");
      const now = Date.now();
      const intervalMs = this.updateNotificationSettings.interval * 60 * 1000;

      if (!lastShown) {
        // First time - show after 30 seconds
        setTimeout(() => {
          this.showCustomUpdateNotification();
          localStorage.setItem(
            "pwa_last_notification_time",
            Date.now().toString()
          );
        }, 30000);
      } else {
        const timeSinceLastShown = now - parseInt(lastShown);

        if (timeSinceLastShown >= intervalMs) {
          this.showCustomUpdateNotification();
          localStorage.setItem("pwa_last_notification_time", now.toString());
        }
      }
    } catch (error) {
      // Silent fail
    }
  }

  // ================================================================
  // Reset Notification Timer (for testing)
  // ================================================================
  resetNotificationTimer() {
    try {
      localStorage.removeItem("pwa_last_notification_time");
      this.loadUpdateNotificationSettings();
    } catch (error) {
      // Silent fail
    }
  }

  // ================================================================
  // Show Custom Update Notification (Cosmetic - No Real Effect)
  // ================================================================
  showCustomUpdateNotification() {
    if (!this.updateNotificationSettings) {
      return;
    }

    if (typeof Swal !== "undefined") {
      Swal.fire({
        title: this.updateNotificationSettings.title,
        text: this.updateNotificationSettings.message,
        icon: "info",
        showCancelButton: true,
        confirmButtonText: this.updateNotificationSettings.confirmText,
        cancelButtonText: this.updateNotificationSettings.cancelText,
        confirmButtonColor: "#667eea",
        allowOutsideClick: true,
        allowEscapeKey: true,
      }).then((result) => {
        // Both buttons just close the dialog - no actual effect
        if (result.isConfirmed) {
          this.showNotification(
            "تم إغلاق الرسالة. التحديثات تحدث تلقائياً في الخلفية.",
            "info"
          );
        }
      });
    } else {
      // Fallback if SweetAlert2 not available
      alert(
        `${this.updateNotificationSettings.title}\n\n${this.updateNotificationSettings.message}`
      );
    }
  }
}

// ================================================================
// Initialize PWA Manager
// ================================================================
let pwaManager;

// Wait for DOM to load
if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", () => {
    pwaManager = new PWAManager();
  });
} else {
  pwaManager = new PWAManager();
}

// Export for global access
window.pwaManager = pwaManager;

// Helper function for manual install trigger
window.installPWA = function () {
  if (pwaManager) {
    pwaManager.install();
  }
};
