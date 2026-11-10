# LAPRIEST — Complete WordPress Setup & Integration Guide

This guide details how to install, configure, and operate the **LAPRIEST** custom WordPress theme, its Custom Post Types, and the Direct Offer system.

---

## 1. Fast Installation (WordPress Admin)

1. Log into your WordPress admin dashboard (`yourdomain.com/wp-admin`).
2. Navigate to **Appearance > Themes**.
3. Click **Add New Theme**, then **Upload Theme**.
4. Choose the `lapriest-theme.zip` file located in this project directory.
5. Click **Install Now**, then click **Activate**.

> **Note on Automatic Page Setup**: When the theme is activated, it will automatically register the Custom Post Types (`catalog_piece` and `editorial_event`), flush rewrite rules, and generate the 3 core page drafts if they do not yet exist:
> * **Home** (Template: `front-page.php`)
> * **Catalog** (Template: `page-catalog.php`)
> * **Quién Soy** (Template: `page-quien-soy.php`)

---

## 2. Setting Homepage & Permalinks

1. In WordPress Admin, go to **Settings > Reading**:
   * Set **Your homepage displays** to **A static page**.
   * Homepage: Select **Home**.
   * Click **Save Changes**.
2. Go to **Settings > Permalinks**:
   * Select **Post name** (`/%postname%/`).
   * Click **Save Changes**.

---

## 3. Managing "Catalog Pieces" (Custom Post Type)

Navigate to **Catalog Pieces > Add New Piece**:

| Field | Location | Description & Example |
| :--- | :--- | :--- |
| **Title** | Standard WP Title | e.g. `PIECE 01: OBSIDIAN DRAPED CAFTAN` |
| **Featured Image** | Document Settings | Primary lookbook portrait (Rick Owens 2:3 vertical ratio, e.g. 1200x1800px). |
| **Garment Code** | Custom Meta Box / ACF | e.g. `LP-FW26-001` (Crucial: dynamically passed to the offer modal). |
| **Baseline Price** | Custom Meta Box / ACF | e.g. `$1,850 USD` |
| **Season / Series** | Custom Meta Box / ACF | e.g. `SERIES 01 // THE ECLIPSE OF ORTHODOXY` |
| **Materials** | Custom Meta Box / ACF | e.g. `100% Japanese High-Density Boiled Raw Selvedge Wool, Internal Cupro Harness.` |
| **Edition Limit** | Custom Meta Box / ACF | e.g. `Edition of 09 Worldwide — Hand Cut in Paris` |
| **Secondary Image URL** | Custom Meta Box / ACF | Media URL for the reverse angle / detail shot revealed on cursor hover. |
| **Acquisition Status** | Custom Meta Box / ACF | Select `Available for Acquisition`, `Reserved`, or `Archival Only`. |
| **Categories** | Right sidebar | Select or add categories: `Outerwear & Capes`, `Tailoring & Tunics`, `Leather & Heavy Goods`, `Footwear`. |

---

## 4. Managing "Editorial & Events" (Custom Post Type)

Navigate to **Editorial & Events > Add New Post**:

| Field | Description & Example |
| :--- | :--- |
| **Title** | e.g. `PALAIS DE TOKYO NOCTURNE: SERIES 01 RUNWAY` |
| **Content** | Full essay, video embeds (Vimeo / YouTube / MP4), runway photography. |
| **Excerpt** | Short 1-2 sentence teaser for the 032c magazine grid. |
| **Featured Image** | High-contrast editorial photo (16:10 or 16:9 ratio, min 1600px wide). |
| **Date / Season Code** | e.g. `OCTOBER 2026 // PARIS FASHION WEEK` |
| **Location / Venue** | e.g. `Sous-Sol Palais de Tokyo, Paris` |
| **Format / Duration** | e.g. `6 MIN RECAP // 4K VISUAL` |
| **Types / Tags** | `Runway`, `Exhibition`, `Atelier Notes`, `Soundscape`, `Monograph`. |

---

## 5. The "Make an Offer" Modal System

### Default: Built-In Native AJAX System (Zero Plugins Required)
The theme comes pre-configured with a native high-fashion modal system:
* When a visitor clicks **"MAKE AN OFFER / INQUIRE"**, JavaScript reads `data-piece-title`, `data-piece-code`, and `data-piece-price` from the card and pre-populates the modal.
* On submission, the form sends an authenticated AJAX request (`wp_ajax_lapriest_submit_offer`) to WordPress.
* A confidential branded HTML notification email is sent directly to the site administrator email (`Settings > General > Administration Email Address`).
* The visitor receives a stylized brutalist confirmation receipt with a unique dossier reference (e.g. `LP-ACQ-9A74E1`).

---

### Alternative: Form Plugin Integrations

If you prefer using an external form plugin, the modal container in `template-parts/modal-offer.php` can be swapped with your plugin's shortcode.

#### Option A: Contact Form 7 Integration
1. In **Contact > Add New**, paste the following markup:

```html
<div class="form-grid-2">
  <div class="form-field-group">
    <label class="form-label">Full Legal Name *</label>
    [text* client-name class:form-input placeholder "e.g. Julian Vane"]
  </div>
  <div class="form-field-group">
    <label class="form-label">Email Address *</label>
    [email* client-email class:form-input placeholder "julian@archive.com"]
  </div>
</div>

<div class="form-grid-2">
  <div class="form-field-group">
    <label class="form-label">Instagram Handle (Optional)</label>
    [text client-instagram class:form-input placeholder "@yourhandle"]
  </div>
  <div class="form-field-group">
    <label class="form-label">Proposed Offer ($ USD) *</label>
    [number* client-offer class:form-input class:form-input-offer min:1 placeholder "1850"]
  </div>
</div>

<div class="form-field-group">
  <label class="form-label">Preferred Response Protocol</label>
  [radio client-reply default:1 "Confidential Email" "Instagram Direct (DM)"]
</div>

<div class="form-field-group">
  <label class="form-label">Measurements or Inquiries</label>
  [textarea client-message class:form-textarea placeholder "Custom sizing notes or appointment request..."]
</div>

[hidden target-piece-title id:fieldPieceTitle]
[hidden target-piece-code id:fieldPieceCode]

<button type="submit" class="btn-submit-offer">
  <span>TRANSMIT PROPOSAL TO ATELIER &rarr;</span>
</button>
```

2. Place `[contact-form-7 id="..." title="Make an Offer"]` inside `template-parts/modal-offer.php`.

#### Option B: WPForms Integration
1. Create a form with:
   * **Name** (Single Line Text)
   * **Email** (Email)
   * **Instagram Handle** (Single Line Text)
   * **Proposed Offer** (Number)
   * **Reply Channel** (Multiple Choice)
   * **Message** (Paragraph Text)
   * **Hidden Fields**: `Garment Title`, `Garment Code` (enable "Allow dynamic field population").
2. Embed via `[wpforms id="..."]`.

---

## 6. Advanced Custom Fields (ACF) JSON Sync

If you install the **Advanced Custom Fields** plugin (Free or Pro):
1. The theme includes pre-built field definitions in `lapriest-theme/acf-json/`:
   * `group_lapriest_piece.json`
   * `group_lapriest_editorial.json`
2. In WordPress Admin, go to **Custom Fields > Field Groups**.
3. If prompted with a "Sync available" badge, click **Sync** to automatically import all curated labels, placeholders, and tooltips.

---

## 7. Web Audio Procedural Drone Feature

The theme includes an ambient 55Hz modular drone soundscape in `assets/js/main.js`:
* Zero external audio files required (100% lightweight procedural Web Audio API).
* Activated by clicking the **[ ATMOSPHERE: OFF ]** button in the header or the **[ ENGAGE 55Hz SOUNDSCAPE ]** button on the home page.
* Creates a hypnotic, warm, sub-bass room tone with a 140Hz lowpass filter for immersive runway ambiance.

