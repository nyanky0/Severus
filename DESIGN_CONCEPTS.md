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

### D. `Engineering Lab Stats Matrix Modal`
- **Component Identifier**: `engineering-lab-stats-modal`
- **Location**: Between "Why Carbon" and "Shaft Guide"
- **Code Blueprint**:
```blade
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="p-8 sm:p-12 rounded-3xl relative overflow-hidden reveal-on-scroll transition-all duration-500"
         :class="currentTheme === 'venom' ? 'venom-glass-card' : 'reaper-glass-card'">
        <div class="absolute inset-0 pointer-events-none"
             :class="currentTheme === 'venom' ? 'bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#00E676]/10 via-transparent to-transparent' : 'bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#E23B3B]/10 via-transparent to-transparent'"></div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
            <div class="lg:col-span-4 space-y-4 text-left">
                <div class="flex items-center space-x-2 text-xs font-mono text-slate-400 uppercase tracking-widest">
                    <span class="w-2 h-2 rounded-full snake-breath" :class="currentTheme === 'venom' ? 'bg-[#00E676]' : 'bg-[#E23B3B]'"></span>
                    <span>ENGINEERING LAB</span>
                </div>
                <h3 class="text-3xl sm:text-4xl font-black text-white font-outfit uppercase">VENOM CARBON SHAFTS</h3>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Tested by world-class billiard professionals. Radial pin joint precision and hydrophobic chalk retention matrix.
                </p>
            </div>

            <div class="lg:col-span-8 flex flex-wrap items-center justify-around gap-6 pt-4 lg:pt-0">
                <div class="flex flex-col items-center justify-center p-6 rounded-3xl bg-[#060506]/80 border shadow-xl min-w-[140px] transform hover:scale-105 transition-all"
                     :class="currentTheme === 'venom' ? 'border-[#00E676]/30' : 'border-[#E23B3B]/30'">
                    <span class="text-xs font-mono text-slate-400 uppercase block mb-1">ACCURACY</span>
                    <span class="text-3xl font-black font-outfit" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">0.12mm</span>
                    <span class="text-[10px] text-slate-500 mt-1">LOW DEFLECTION</span>
                </div>

                <div class="flex flex-col items-center justify-center p-6 rounded-3xl shadow-2xl min-w-[140px] transform hover:scale-105 transition-all"
                     :class="currentTheme === 'venom' ? 'bg-[#00E676] text-black shadow-[0_0_30px_rgba(0,230,118,0.5)]' : 'bg-[#E23B3B] text-white shadow-[0_0_30px_rgba(226,59,59,0.5)]'">
                    <span class="text-xs font-mono font-bold uppercase block mb-1">RETENTION</span>
                    <span class="text-3xl font-black font-outfit">99.8%</span>
                    <span class="text-[10px] font-extrabold uppercase mt-1">CHALK FRICTION</span>
                </div>

                <div class="flex flex-col items-center justify-center p-6 rounded-3xl bg-[#060506]/80 border shadow-xl min-w-[140px] transform hover:scale-105 transition-all"
                     :class="currentTheme === 'venom' ? 'border-[#00E676]/30' : 'border-[#E23B3B]/30'">
                    <span class="text-xs font-mono text-slate-400 uppercase block mb-1">JOINT PIN</span>
                    <span class="text-2xl font-black text-white font-outfit">UNI-LOC</span>
                    <span class="text-[10px] text-slate-500 mt-1">RADIAL BRASS</span>
                </div>

                <div class="flex flex-col items-center justify-center p-6 rounded-3xl bg-[#060506]/80 border shadow-xl min-w-[140px] transform hover:scale-105 transition-all"
                     :class="currentTheme === 'venom' ? 'border-[#00E676]/30' : 'border-[#E23B3B]/30'">
                    <span class="text-xs font-mono text-slate-400 uppercase block mb-1">FLAGSHIP</span>
                    <span class="text-2xl font-black font-outfit" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'">Rp 2.95M</span>
                    <span class="text-[10px] text-slate-500 mt-1">REAPER V2 PRO</span>
                </div>
            </div>
        </div>
    </div>
</section>
```

---

### E. `Authentic Quality Guarantee Badge`
- **Component Identifier**: `authentic-quality-guarantee-badge`
- **Location**: Section 1 (Hero Section — Under CTAs)
- **Code Blueprint**:
```blade
<div class="pt-2 text-center lg:text-left">
    <span class="serpent-shimmer inline-flex items-center space-x-2 px-4 py-2 rounded-full border border-white/10 bg-white/5 text-[10px] uppercase tracking-[0.2em] text-slate-300 font-bold">
        <svg class="w-3.5 h-3.5" :class="currentTheme === 'venom' ? 'text-[#00E676]' : 'text-[#E23B3B]'" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2 2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
        <span>100% Authentic Severus Quality Guarantee</span>
    </span>
</div>
```

---

## 2. Typography System

| Name | Source | CSS Class | Primary Usage |
| :--- | :--- | :--- | :--- |
| **Outfit** | Google Fonts | `.font-outfit` | Severus Cues brand display, UI badges, technical specifications |
| **Boska** | Fontshare CDN | `.font-boska` | Shaft Guide headline, Reaper edition title, luxury display |
| **Cinzel** | Google Fonts | `.font-cinzel` | Quote banners, product titles, secondary headlines |
| **Cinzel Decorative** | Google Fonts | `.font-gothic` | Gothic Roman ornate headings, alternate Reaper branding |
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
- *"Add Engineering Lab Stats Matrix Modal"*
- *"Add Authentic Quality Guarantee Badge"*
- *"Apply Boska font"*
