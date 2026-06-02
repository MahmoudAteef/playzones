// V2 Unified Checkout - Simplified JavaScript
// Key Difference: No payment method selection (handled by Paymob Unified)

let currentPlanData = null;

// Subscribe button handler
document.addEventListener("click", (e) => {
  const subscribeLink = e.target.closest(".pricing-card a[data-subscribe]");
  if (!subscribeLink) return;
  e.preventDefault();
  e.stopPropagation();

  const card = subscribeLink.closest(".pricing-card");
  if (!card) return;

  const planId = parseInt(card.getAttribute("data-plan-id") || "0");
  const period = card.getAttribute("data-period") || "monthly";
  const planName =
    card.querySelector("h3")?.textContent?.trim() || "الباقة المختارة";

  if (!planId) {
    alert("خطأ: معرف الباقة غير موجود");
    return;
  }

  currentPlanData = { planId, period, planName };
  openSubscriptionModal(planId, period, planName);
});

function openSubscriptionModal(planId, period, planName) {
  const modal = document.getElementById("subscriptionModal");
  const form = document.getElementById("subscriptionForm");
  const confirmationStep = document.getElementById("confirmationStep");

  document.getElementById("modalPlanId").value = planId;
  document.getElementById("modalPricingPeriod").value = period;
  document.getElementById("modalPlanName").textContent = planName;

  form.reset();
  form.classList.remove("hidden");
  confirmationStep.classList.add("hidden");
  document.getElementById("subError").classList.add("hidden");

  modal.classList.remove("hidden");
}

function closeSubscriptionModal() {
  document.getElementById("subscriptionModal").classList.add("hidden");
  currentPlanData = null;
}

// Modal handlers
document.addEventListener("DOMContentLoaded", () => {
  console.log("✅ V2 Unified Checkout loaded");
  console.log("📡 API Base:", window.API_BASE);

  document
    .getElementById("closeModal")
    ?.addEventListener("click", closeSubscriptionModal);
  document
    .getElementById("cancelBtn")
    ?.addEventListener("click", closeSubscriptionModal);

  document
    .getElementById("subscriptionModal")
    ?.addEventListener("click", (e) => {
      if (e.target.id === "subscriptionModal") {
        closeSubscriptionModal();
      }
    });

  // Phone validation
  const phoneInput = document.getElementById("subPhone");
  const phoneCounter = document.getElementById("phoneCounter");

  if (phoneInput && phoneCounter) {
    phoneInput.addEventListener("input", (e) => {
      e.target.value = e.target.value.replace(/[^0-9]/g, "");
      const length = e.target.value.length;
      phoneCounter.textContent = `${length} / 11`;

      if (length === 11 && e.target.value.startsWith("01")) {
        phoneCounter.classList.remove(
          "text-indigo-600",
          "dark:text-indigo-400",
          "text-red-600",
          "dark:text-red-400"
        );
        phoneCounter.classList.add("text-green-600", "dark:text-green-400");
      } else if (length > 0) {
        phoneCounter.classList.remove(
          "text-indigo-600",
          "dark:text-indigo-400",
          "text-green-600",
          "dark:text-green-400"
        );
        phoneCounter.classList.add("text-red-600", "dark:text-red-400");
      } else {
        phoneCounter.classList.remove(
          "text-red-600",
          "dark:text-red-400",
          "text-green-600",
          "dark:text-green-400"
        );
        phoneCounter.classList.add("text-indigo-600", "dark:text-indigo-400");
      }
    });
  }

  // Name validation
  const nameInput = document.getElementById("subName");
  if (nameInput) {
    nameInput.addEventListener("input", (e) => {
      e.target.value = e.target.value.replace(/[^A-Za-z\s]/g, "");
    });

    nameInput.addEventListener("paste", (e) => {
      e.preventDefault();
      const text = (e.clipboardData || window.clipboardData).getData("text");
      const cleanText = text.replace(/[^A-Za-z\s]/g, "");
      document.execCommand("insertText", false, cleanText);
    });
  }

  // Email sanitization
  const emailInput = document.getElementById("subEmail");
  if (emailInput) {
    emailInput.addEventListener("input", (e) => {
      e.target.value = e.target.value.replace(/[<>'"]/g, "");
    });
  }

  // Form submission
  document
    .getElementById("subscriptionForm")
    ?.addEventListener("submit", async (e) => {
      e.preventDefault();

      const form = e.target;
      const name = form.name.value.trim();
      const phone = form.phone.value.trim();
      const email = form.email.value.trim();
      const errorDiv = document.getElementById("subError");

      // Validation
      if (!name || !phone || !email) {
        errorDiv.textContent = "يرجى ملء جميع الحقول";
        errorDiv.classList.remove("hidden");
        return;
      }

      if (!/^[A-Za-z\s]{2,}$/.test(name)) {
        errorDiv.textContent = "يرجى إدخال الاسم بالإنجليزية فقط";
        errorDiv.classList.remove("hidden");
        return;
      }

      if (!/^01[0-9]{9}$/.test(phone)) {
        errorDiv.textContent = "رقم الهاتف يجب أن يكون 11 رقم ويبدأ بـ 01";
        errorDiv.classList.remove("hidden");
        return;
      }

      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        errorDiv.textContent = "البريد الإلكتروني غير صحيح";
        errorDiv.classList.remove("hidden");
        return;
      }

      errorDiv.classList.add("hidden");

      // Check for existing customer
      try {
        const apiBase = window.API_BASE || "../../api/landing-public-v2.php";
        const checkRes = await fetch(
          `${apiBase}?action=billing:check-customer`,
          {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ name, phone, email }),
          }
        );

        const checkData = await checkRes.json();

        if (checkData.success && checkData.exists) {
          const client = checkData.client;
          const matchedFieldsAr = {
            name: "الاسم",
            email: "البريد الإلكتروني",
            phone: "رقم الهاتف",
          };
          const matchedText = client.matched_fields
            .map((f) => matchedFieldsAr[f])
            .join(" و ");

          document.getElementById("customerCodeValue").textContent =
            client.client_code;
          document.getElementById("customerUsernameValue").textContent =
            client.username;
          document.getElementById("matchedFieldsText").textContent =
            matchedText;

          const modal = document.getElementById("existingCustomerModal");
          modal.classList.remove("hidden");

          const userConfirmed = await new Promise((resolve) => {
            const confirmBtn = document.getElementById(
              "confirmExistingCustomer"
            );
            const cancelBtn = document.getElementById("cancelExistingCustomer");

            const handleConfirm = () => {
              modal.classList.add("hidden");
              confirmBtn.removeEventListener("click", handleConfirm);
              cancelBtn.removeEventListener("click", handleCancel);
              resolve(true);
            };

            const handleCancel = () => {
              modal.classList.add("hidden");
              confirmBtn.removeEventListener("click", handleConfirm);
              cancelBtn.removeEventListener("click", handleCancel);
              resolve(false);
            };

            confirmBtn.addEventListener("click", handleConfirm);
            cancelBtn.addEventListener("click", handleCancel);
          });

          if (!userConfirmed) {
            return;
          }
        }
      } catch (err) {
        console.warn("Customer check failed:", err);
      }

      // Show confirmation
      const periodText = {
        monthly: "شهري",
        quarterly: "ربع سنوي",
        yearly: "سنوي",
      };

      document.getElementById("confirmPlan").textContent = `${
        currentPlanData.planName
      } (${periodText[currentPlanData.period]})`;
      document.getElementById("confirmName").textContent = name;
      document.getElementById("confirmPhone").textContent = phone;
      document.getElementById("confirmEmail").textContent = email;

      form.classList.add("hidden");
      document.getElementById("confirmationStep").classList.remove("hidden");
    });

  // Back button
  document.getElementById("backBtn")?.addEventListener("click", () => {
    document.getElementById("confirmationStep").classList.add("hidden");
    document.getElementById("subscriptionForm").classList.remove("hidden");
  });

  // Proceed to payment - V2 Unified
  document
    .getElementById("proceedPaymentBtn")
    ?.addEventListener("click", async () => {
      const btn = document.getElementById("proceedPaymentBtn");
      const originalText = btn.textContent;
      btn.disabled = true;
      btn.textContent = "جاري المعالجة...";

      try {
        const form = document.getElementById("subscriptionForm");
        const planId = parseInt(document.getElementById("modalPlanId").value);
        const period = document.getElementById("modalPricingPeriod").value;
        const name = form.name.value.trim();
        const phone = form.phone.value.trim();
        const email = form.email.value.trim();

        const apiBase = window.API_BASE || "../../api/landing-public-v2.php";

        console.log("🚀 Creating payment intent...");

        // Step 1: Create intent
        const intentRes = await fetch(`${apiBase}?action=billing:init-intent`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            plan_id: planId,
            pricing_period: period,
            name,
            phone,
            email,
          }),
        });

        const intentData = await intentRes.json();

        if (!intentData.success) {
          const errorMessages = {
            invalid_name: "الاسم غير صحيح (إنجليزي فقط)",
            invalid_phone: "رقم الهاتف غير صحيح",
            invalid_phone_length: "رقم الهاتف يجب أن يكون 11 رقم ويبدأ بـ 01",
            invalid_email: "البريد الإلكتروني غير صحيح",
            customer_exists: "هذا البريد أو الهاتف مستخدم بالفعل",
            invalid_plan_or_period: "الباقة المختارة غير صحيحة",
            invalid_input: "البيانات المدخلة تحتوي على أحرف غير مسموحة",
          };
          throw new Error(
            errorMessages[intentData.message] || "فشل حفظ البيانات"
          );
        }

        const intentId = intentData.intent_id;
        console.log("✅ Intent created:", intentId);

        // Step 2: Create Unified Checkout
        console.log("🚀 Creating Unified Checkout...");

        const checkoutRes = await fetch(`${apiBase}?action=billing:checkout`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            intent_id: intentId,
          }),
        });

        const checkoutData = await checkoutRes.json();

        if (checkoutData.success && checkoutData.checkout_url) {
          console.log("✅ Unified Checkout created!");
          console.log("🔗 Checkout URL:", checkoutData.checkout_url);
          console.log("💳 Payment Methods:", checkoutData.payment_methods);

          // Redirect to Paymob Unified Checkout
          window.location.href = checkoutData.checkout_url;
        } else {
          throw new Error(checkoutData.error || "فشل إنشاء جلسة الدفع");
        }
      } catch (err) {
        console.error("❌ Payment Error:", err);
        alert(err.message || "حدث خطأ، يرجى المحاولة مرة أخرى");
        btn.disabled = false;
        btn.textContent = originalText;
      }
    });
});

// Copy all other handlers from V1 (hero, pricing toggle, FAQs, etc.)
// These are identical between V1 and V2

// Basic enhancements
document.addEventListener("DOMContentLoaded", () => {
  // Smooth scroll
  document.querySelectorAll('a[href^="#"]').forEach((a) => {
    a.addEventListener("click", (e) => {
      const href = a.getAttribute("href");
      if (
        a.hasAttribute("data-subscribe") ||
        (href === "#cta" && a.closest(".pricing-card"))
      ) {
        return;
      }
      const id = href.substring(1);
      const el = document.getElementById(id);
      if (el) {
        e.preventDefault();
        el.scrollIntoView({ behavior: "smooth", block: "start" });
      }
    });
  });

  // Mobile menu toggle
  const menuBtn = document.getElementById("mobileMenuToggle");
  const mobileMenu = document.getElementById("mobileMenu");
  if (menuBtn && mobileMenu) {
    menuBtn.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden");
    });
  }

  // Hero background rotator
  (function () {
    const hero = document.getElementById("hero");
    if (!hero) return;
    const dataList = (hero.getAttribute("data-hero-images") || "")
      .split(",")
      .map((s) => s.trim())
      .filter(Boolean);
    const images = dataList.length
      ? dataList
      : [
          "assets/img/person-wearing-futuristic-virtual-reality-glasses-gaming.jpg",
        ];
    let idx = 0;
    const layer = hero.querySelector("[data-hero-bg]");

    if (layer) {
      layer.style.left = "0";
      layer.style.right = "0";
      layer.style.top = "0";
      layer.style.bottom = "0";
      layer.style.position = "absolute";
      layer.style.backgroundPosition = "center";
      layer.style.backgroundSize = "cover";
      layer.style.backgroundRepeat = "no-repeat";
    }

    const apply = (url) => {
      if (!layer) return;
      layer.style.opacity = "0";
      setTimeout(() => {
        layer.style.backgroundImage = `url(${url})`;
        layer.style.opacity = "1";
      }, 200);
    };

    const next = () => {
      idx = (idx + 1) % images.length;
      apply(images[idx]);
    };

    const prev = () => {
      idx = (idx - 1 + images.length) % images.length;
      apply(images[idx]);
    };

    apply(images[idx]);

    const ROTATE_MS = 120000; // 2 minutes
    let timer = null;
    const schedule = () => {
      timer = setTimeout(() => {
        next();
        schedule();
      }, ROTATE_MS);
    };
    schedule();

    const resetTimer = () => {
      if (timer) clearTimeout(timer);
      schedule();
    };

    const prevBtn = document.getElementById("heroPrev");
    const nextBtn = document.getElementById("heroNext");
    if (prevBtn)
      prevBtn.addEventListener("click", () => {
        prev();
        resetTimer();
      });
    if (nextBtn)
      nextBtn.addEventListener("click", () => {
        next();
        resetTimer();
      });
  })();

  // Theme toggle for mobile
  const themeBtnMobile = document.getElementById("themeToggleMobile");
  if (themeBtnMobile) {
    themeBtnMobile.addEventListener("click", () => {
      document.documentElement.classList.toggle("dark");
      localStorage.setItem(
        "themePref",
        document.documentElement.classList.contains("dark") ? "dark" : "light"
      );
    });
  }

  // Pricing period toggle
  const monthlyBtn = document.getElementById("pricingToggleMonthly");
  const quarterlyBtn = document.getElementById("pricingToggleQuarterly");
  const pricingCards = document.querySelectorAll(".pricing-card");

  if (monthlyBtn && quarterlyBtn && pricingCards.length) {
    const filterPricing = (period) => {
      pricingCards.forEach((card) => {
        const cardPeriod = card.getAttribute("data-period");
        if (cardPeriod === period || cardPeriod === "both") {
          card.style.display = "";
        } else {
          card.style.display = "none";
        }
      });
    };

    monthlyBtn.addEventListener("click", () => {
      monthlyBtn.classList.add("active");
      quarterlyBtn.classList.remove("active");
      filterPricing("monthly");
    });

    quarterlyBtn.addEventListener("click", () => {
      quarterlyBtn.classList.add("active");
      monthlyBtn.classList.remove("active");
      filterPricing("quarterly");
    });

    filterPricing("monthly");
  }

  // Ratings
  (function () {
    const rateWrap = document.getElementById("rateNow");
    if (!rateWrap) return;
    const totalEl = document.getElementById("ratingTotalCount");
    const avgEl = document.getElementById("ratingAverageValue");
    const starBtns = Array.from(rateWrap.querySelectorAll(".rate-star"));
    starBtns.forEach((b) => b.classList.add("opacity-30"));

    function parseCount(el) {
      if (!el) return 0;
      const txt = el.textContent || "";
      const m = txt.match(/(\d+)/);
      return m ? parseInt(m[1]) : 0;
    }

    function updateUI() {
      let total = 0,
        sum = 0;
      for (let s = 1; s <= 5; s++) {
        const cEl = document.getElementById("ratingCount-" + s);
        const count = cEl ? parseInt(cEl.textContent || "0") : 0;
        total += count;
        sum += count * s;
      }
      if (totalEl) totalEl.textContent = total + " تقييم";
      if (avgEl) avgEl.textContent = total ? (sum / total).toFixed(1) : "0.0";
      for (let s = 1; s <= 5; s++) {
        const cEl = document.getElementById("ratingCount-" + s);
        const pEl = document.getElementById("ratingProg-" + s);
        const count = cEl ? parseInt(cEl.textContent || "0") : 0;
        const percent = total ? Math.round((count / total) * 100) : 0;
        if (pEl) pEl.style.width = percent + "%";
      }
    }

    function highlight(star) {
      starBtns.forEach((b) => {
        const s = parseInt(b.getAttribute("data-star"));
        if (s <= star) b.classList.remove("opacity-30");
        else b.classList.add("opacity-30");
      });
    }

    const saved = parseInt(localStorage.getItem("landingUserRating") || "0");
    if (saved > 0) highlight(saved);

    starBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        const star = parseInt(btn.getAttribute("data-star"));
        const prev = parseInt(localStorage.getItem("landingUserRating") || "0");

        if (star !== prev) {
          const incEl = document.getElementById("ratingCount-" + star);
          if (incEl)
            incEl.textContent = String(
              (parseInt(incEl.textContent || "0") || 0) + 1
            );
          if (prev > 0) {
            const decEl = document.getElementById("ratingCount-" + prev);
            if (decEl) {
              const v = (parseInt(decEl.textContent || "0") || 0) - 1;
              decEl.textContent = String(Math.max(0, v));
            }
          }
          localStorage.setItem("landingUserRating", String(star));
          highlight(star);
          updateUI();
        }
      });
    });

    updateUI();
  })();

  // FAQ accordion
  (function () {
    const container = document.querySelector('[data-accordion="faq"]');
    if (!container) return;
    const buttons = container.querySelectorAll("button[aria-controls]");
    const hideAll = () => {
      buttons.forEach((b) => b.setAttribute("aria-expanded", "false"));
      container
        .querySelectorAll(".faq-panel")
        .forEach((p) => p.classList.add("hidden"));
      container
        .querySelectorAll(".icon-minus")
        .forEach((i) => i.classList.add("hidden"));
      container
        .querySelectorAll(".icon-plus")
        .forEach((i) => i.classList.remove("hidden"));
    };
    buttons.forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        const panelId = btn.getAttribute("aria-controls");
        const panel = document.getElementById(panelId);
        if (!panel) return;
        const expanded = btn.getAttribute("aria-expanded") === "true";
        hideAll();
        if (!expanded) {
          btn.setAttribute("aria-expanded", "true");
          panel.classList.remove("hidden");
          const plus = btn.querySelector(".icon-plus");
          const minus = btn.querySelector(".icon-minus");
          if (plus) plus.classList.add("hidden");
          if (minus) minus.classList.remove("hidden");
        }
      });
    });

    // بعد تفعيل الأكورديون: رتب الصور داخل الإجابة على صف واحد كصور مصغّرة
    const contents = container.querySelectorAll(".faq-panel .faq-content");
    contents.forEach((contentEl) => {
      if (contentEl.classList.contains("faq-images-row")) return;
      const hasImages = contentEl.querySelector("img");
      if (!hasImages) return;
      // طبّق الصف المصغّر دائمًا لتحسين العرض إذا وُجدت صور
      contentEl.classList.add("faq-images-row");
    });
  })();

  // Lead/contact form (copied from V1 - identical)
  (function () {
    const form = document.getElementById("contactLeadForm");
    if (!form) return;

    // Governorate combobox
    (function () {
      const root = document.getElementById("govSelect");
      const input = document.getElementById("leadGovernorateSearch");
      const hidden = document.getElementById("leadGovernorate");
      const dropdown = document.getElementById("govDropdown");
      const list = document.getElementById("govList");
      if (!root || !input || !hidden || !dropdown || !list) return;

      const open = () => dropdown.classList.remove("hidden");
      const close = () => dropdown.classList.add("hidden");

      input.addEventListener("focus", open);
      input.addEventListener("click", (e) => {
        e.stopPropagation();
        open();
      });
      document.addEventListener("click", (e) => {
        if (!root.contains(e.target)) close();
      });

      input.addEventListener("input", () => {
        const q = (input.value || "").trim();
        Array.from(list.children).forEach((li) => {
          const t = li.textContent || "";
          li.style.display = t.includes(q) ? "" : "none";
        });
        open();
      });

      list.querySelectorAll("li").forEach((li) => {
        li.addEventListener("click", () => {
          const val = li.getAttribute("data-value") || li.textContent || "";
          hidden.value = val;
          input.value = val;
          close();
        });
      });
    })();

    const nameEl = document.getElementById("leadName");
    const phoneEl = document.getElementById("leadPhone");
    const waEl = document.getElementById("leadWhatsApp");
    const emailEl = document.getElementById("leadEmail");
    const addrEl = document.getElementById("leadAddress");
    const govEl = document.getElementById("leadGovernorate");
    const statusEl = document.getElementById("leadFormStatus");
    const prefWhats = document.getElementById("prefWhatsApp");
    const prefEmail = document.getElementById("prefEmail");
    const waHint = document.getElementById("leadWhatsAppHint");
    const emailHint = document.getElementById("leadEmailHint");
    const methodHint = document.getElementById("leadMethodHint");
    const phoneHint = document.getElementById("leadPhoneHint");

    const enforce11 = (input, hint) => {
      if (!input) return;
      input.addEventListener("input", () => {
        const digits = (input.value || "").replace(/[^0-9]/g, "");
        if (digits.length > 11) {
          input.value = digits.slice(0, 11);
          if (hint) hint.textContent = "تم الملء";
        } else {
          input.value = digits;
          const left = 11 - digits.length;
          if (hint)
            hint.textContent = left > 0 ? `متبقي ${left} أرقام` : "تم الملء";
        }
      });
    };
    enforce11(phoneEl, phoneHint);
    enforce11(waEl, waHint);

    const phoneRegex = /^\d{10,15}$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      statusEl.textContent = "";
      if (methodHint) methodHint.textContent = "";
      if (waHint) waHint.textContent = "";
      if (emailHint) emailHint.textContent = "";

      const name = (nameEl?.value || "").trim();
      const phone = (phoneEl?.value || "").trim();
      const whatsapp = (waEl?.value || "").trim();
      const email = (emailEl?.value || "").trim();
      const address = (addrEl?.value || "").trim();
      const gov = (govEl?.value || "").trim();

      const prefer = prefWhats?.checked
        ? "whatsapp"
        : prefEmail?.checked
        ? "email"
        : "";
      const missing = [];
      if (!name) missing.push("اسم العميل");
      const waDigitsNow = (whatsapp || "").replace(/[^0-9]/g, "");
      if (waDigitsNow.length !== 11)
        missing.push(
          `رقم الواتساب: ${
            waDigitsNow.length < 11
              ? `متبقي ${11 - waDigitsNow.length}`
              : "تم الملء"
          }`
        );
      if (!email || !emailRegex.test(email)) missing.push("البريد الإلكتروني");
      if (!gov) missing.push("المحافظة");
      const phoneDigitsNow = (phone || "").replace(/[^0-9]/g, "");
      if (phone && phoneDigitsNow.length !== 11)
        missing.push(
          `رقم الهاتف: ${
            phoneDigitsNow.length < 11
              ? `متبقي ${11 - phoneDigitsNow.length}`
              : "تم الملء"
          }`
        );
      if (!prefer) missing.push("طريقة الاستلام");

      if (missing.length) {
        statusEl.textContent = `أكمل الحقول: ${missing.join("، ")}`;
        statusEl.classList.remove(
          "text-gray-600",
          "text-green-600",
          "text-red-600"
        );
        statusEl.classList.add("text-amber-600", "font-medium");
        if (!prefer && methodHint) methodHint.textContent = "هذا الحقل مطلوب";
        return;
      }

      if (prefer === "whatsapp") {
        const wa = (waEl?.value || "").trim();
        const digits = wa.replace(/[^0-9]/g, "");
        const needed = Math.max(0, 11 - digits.length);
        if (!wa || digits.length !== 11) {
          statusEl.textContent = "يرجى إدخال رقم واتساب صالح (11 رقمًا)";
          if (waHint)
            waHint.textContent =
              needed > 0 ? `متبقي ${needed} أرقام` : "تم الملء";
          waEl?.focus();
          return;
        }
      }

      if (prefer === "email") {
        const em = (emailEl?.value || "").trim();
        if (!em || !emailRegex.test(em)) {
          statusEl.textContent =
            "يرجى إدخال بريد إلكتروني صالح (لاستلام البيانات)";
          if (emailHint) emailHint.textContent = "صيغة البريد غير صحيحة";
          emailEl?.focus();
          return;
        }
      }

      try {
        statusEl.textContent = "جاري الإرسال...";
        const method = document.querySelector(
          'input[name="leadDeliveryMethod"]:checked'
        )?.value;
        const payload = {
          name,
          phone: phoneDigitsNow || null,
          whatsapp: waDigitsNow,
          email,
          address,
          governorate: gov,
          preferred_method: method,
          website_url: "",
        };

        const url = `${
          window.API_BASE || "../../api/landing-public-v2.php"
        }?only=lead`;
        const res = await fetch(url, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(payload),
        });
        const data = await res.json();

        if (!data || !data.success) {
          if (data && data.message === "duplicate_whatsapp") {
            statusEl.textContent = "رقم الواتساب مستخدم بالفعل";
          } else if (data && data.message === "duplicate_email") {
            statusEl.textContent = "البريد الإلكتروني مستخدم بالفعل";
          } else {
            statusEl.textContent = "تعذّر الإرسال، حاول مرة أخرى";
          }
          statusEl.classList.remove("text-green-600");
          statusEl.classList.add("text-red-600");
          return;
        }

        statusEl.textContent = "تم الإرسال بنجاح";
        form.reset();
        govEl.value = "";
        if (prefWhats) prefWhats.checked = false;
        if (prefEmail) prefEmail.checked = false;

        const modal = document.getElementById("leadSuccessModal");
        const methodSpan = document.getElementById("leadSelectedMethod");
        const methodText =
          prefer === "whatsapp" ? "الواتساب" : "البريد الإلكتروني";
        if (methodSpan) methodSpan.textContent = methodText;
        if (modal) modal.classList.remove("hidden");
        const closeBtn = document.getElementById("leadSuccessClose");
        const backdrop = document.getElementById("leadSuccessBackdrop");
        const closeModal = () => modal.classList.add("hidden");
        if (closeBtn) closeBtn.onclick = closeModal;
        if (backdrop) backdrop.onclick = closeModal;
      } catch (err) {
        statusEl.textContent = "تعذّر الإرسال، حاول مرة أخرى";
      }
    });
  })();
});
