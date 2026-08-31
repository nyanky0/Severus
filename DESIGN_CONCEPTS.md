# Severus Cues — Design Concepts & UI Component Library

This document catalogues named design concepts, overlay modals, typography presets, and component blueprints used across the **Severus Cues** application.

---

## 1. Named Overlay Modals (Glass HUD Tags)

These are frosted liquid-glass overlay cards placed inside media containers (`aspect-square` or hero cards) with backdrop blur and theme-reactive accents.

### A. `Brand Manifesto Overlay Modal`
- **Component Identifier**: `brand-manifesto-modal`
- **Location**: Section 5 (Brand Lifestyle Photography) — Left Card (`/images/lifestyle_quote.jpg`)
- **Code Blueprint**:
```blade
<div class="absolute inset-0 bg-gradient-to-t from-black/85 via-transparent to-transparent opacity-70 group-hover:opacity-50 transition-opacity"></div>

<div class="absolute bottom-4 left-4 right-4 p-4 rounded-xl glass border border-white/10 backdrop-blur-md space-y-1">
    <span class="text-[10px] font-mono uppercase tracking-[0.25em] text-slate-400 font-bold block"
          :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#FF4D5E]'">
        BRAND MANIFESTO
    </span>
    <p class="text-xs sm:text-sm font-bold text-white font-cinzel tracking-wider">
        "WHERE THE GAME IS NOT JUST PLAYED, IT'S LIVED."
    </p>
</div>
```

---

### B. `Precision Assembly Overlay Modal`
- **Component Identifier**: `precision-assembly-modal`
- **Location**: Section 5 (Brand Lifestyle Photography) — Right Card (`/images/lifestyle_joint.jpg`)
- **Code Blueprint**:
```blade
<div class="absolute inset-0 bg-gradient-to-t from-black/85 via-transparent to-transparent opacity-70 group-hover:opacity-50 transition-opacity"></div>

<div class="absolute bottom-4 left-4 right-4 p-4 rounded-xl glass border border-white/10 backdrop-blur-md space-y-1">
    <span class="text-[10px] font-mono uppercase tracking-[0.25em] text-slate-400 font-bold block"
          :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#FF4D5E]'">
        PRECISION ASSEMBLY
    </span>
    <p class="text-xs sm:text-sm font-bold text-white font-outfit uppercase tracking-wider">
        Seamless Carbon Joint Pin & Custom Extension Bumper
    </p>
</div>
```

---

### C. `Play Shaft Specs Overlay Modal`
- **Component Identifier**: `play-shaft-specs-modal`
- **Location**: Section 4 (Play Shaft Spotlight Card — Right Photo)
- **Code Blueprint**:
```blade
<div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent pointer-events-none"></div>
<div class="absolute bottom-3 left-3 right-3 p-3 rounded-xl glass border border-white/10 text-center">
    <span class="text-[10px] font-mono tracking-widest text-slate-300 uppercase font-bold">
        SEVERUS PRECISION CARBON CUE SHAFTS
    </span>
</div>
```

---

## 2. Typography System

| Name | Source | CSS Class | Primary Usage |
| :--- | :--- | :--- | :--- |
| **Boska** | Fontshare CDN | `.font-boska` | Shaft Guide headline, Reaper edition title, luxury display |
| **Cinzel** | Google Fonts | `.font-cinzel` | Hero headlines, brand quote banners, product titles |
| **Cinzel Decorative** | Google Fonts | `.font-gothic` | Gothic Roman ornate headings, alternate Reaper branding |
| **Outfit** | Google Fonts | `.font-outfit` | UI badges, technical specifications, modern subtitles |
| **Inter** | Google Fonts | `.font-sans` | Body copy, administrative controls, specifications |
| **JetBrains Mono** | Google Fonts | `.font-mono` | Joint pin badges, numbers (01-04), precision data |

---

## 3. Brand Theme Palettes

### 🔴 Reaper Theme (Default)
- **Base Background**: `#080608` (Deep Obsidian)
- **Card Gradient**: `#140b0e` to `#080506`
- **Primary Accent**: `#E23B3B` (Blood Crimson)
- **Highlight Flame**: `#FF4D5E`
- **Atmospheric Glow**: `rgba(226, 59, 59, 0.25)`

### 🟢 Venom Theme
- **Base Background**: `#070d0a` (Venom Obsidian)
- **Card Gradient**: `#0a140f` to `#060a08`
- **Primary Accent**: `#00E676` (Electric Emerald)
- **Highlight Snake**: `#10B981`
- **Atmospheric Glow**: `rgba(0, 230, 118, 0.25)`

---

## 4. How to Recall Components in Chat
To restore or reuse any overlay modal or design preset, simply mention:
- *"Add Brand Manifesto Modal"*
- *"Add Precision Assembly Modal"*
- *"Add Play Shaft Specs Modal"*
- *"Apply Boska font"*
