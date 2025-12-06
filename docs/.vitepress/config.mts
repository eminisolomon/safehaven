import { defineConfig } from "vitepress";

export default defineConfig({
  title: "SafeHaven",
  description: "Documentation for SafeHaven",
  themeConfig: {
    nav: [
      { text: "Home", link: "/" },
      { text: "Getting Started", link: "/getting-started" },
    ],

    sidebar: [
      {
        text: "Guide",
        items: [
          { text: "Getting Started", link: "/getting-started" },
          { text: "Account", link: "/account" },
          { text: "Beneficiary", link: "/beneficiary" },
          { text: "Transfer", link: "/transfer" },
          { text: "Verification", link: "/verification" },
        ],
      },
      {
        text: "Payments & Billing",
        items: [
          { text: "Billing", link: "/billing" },
          { text: "Virtual Account", link: "/virtual-account" },
          { text: "Checkout JS", link: "/checkout-js" },
          { text: "Webhooks", link: "/webhooks" },
        ],
      },
    ],

    socialLinks: [
      { icon: "github", link: "https://github.com/eminisolomon/safehaven" },
    ],
  },
});
