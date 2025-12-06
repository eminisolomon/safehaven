import { defineConfig } from "vitepress";

export default defineConfig({
  title: "SafeHaven",
  description: "Documentation for SafeHaven",
  themeConfig: {
    nav: [
      { text: "Home", link: "/" },
      { text: "Getting Started", link: "/getting-started" },
      { text: "SafeHaven MFB", link: "https://safehavenmfb.com/" },
      {
        text: "API Reference",
        link: "https://safehavenmfb.readme.io/reference",
      },
    ],

    sidebar: [
      {
        text: "Guide",
        items: [{ text: "Getting Started", link: "/getting-started" }],
      },
      {
        text: "Core Services",
        items: [
          { text: "Account Management", link: "/account" },
          { text: "Beneficiary Management", link: "/beneficiary" },
          { text: "Transfer Management", link: "/transfer" },
          { text: "Verification Services", link: "/verification" },
        ],
      },
      {
        text: "Payments & Integration",
        items: [
          { text: "Billing Management", link: "/billing" },
          { text: "Virtual Accounts", link: "/virtual-account" },
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
