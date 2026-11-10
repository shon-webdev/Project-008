/**
 * LAPRIEST Haute Brutalisme - Motor Principal
 * Modal Dinámico de Ofertas, Filtros de Categoría, Atmósfera Sonora e Interacciones
 * JavaScript Nativo Moderno ES6+ sin dependencias externas
 */

document.addEventListener('DOMContentLoaded', () => {
  initLiveTimecodes();
  initOfferModal();
  initCategoryFilters();
  initAmbientSoundscape();
  initMobileNav();
  initImageHoverPreload();
  initTypographySwitcher();
});

/* ==========================================================================
   1. HORARIOS EN VIVO DE ATELIERS (PARÍS Y TOKIO)
   ========================================================================== */
function initLiveTimecodes() {
  const parisTimeEl = document.getElementById('paris-time');
  const tokyoTimeEl = document.getElementById('tokyo-time');

  function updateClocks() {
    const now = new Date();
    
    // Hora de París (Europe/Paris)
    if (parisTimeEl) {
      const parisStr = now.toLocaleTimeString('es-ES', {
        timeZone: 'Europe/Paris',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
      });
      parisTimeEl.textContent = `ATELIER PARÍS: ${parisStr} CET`;
    }

    // Hora de Tokio (Asia/Tokyo)
    if (tokyoTimeEl) {
      const tokyoStr = now.toLocaleTimeString('es-ES', {
        timeZone: 'Asia/Tokyo',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
      });
      tokyoTimeEl.textContent = `ARCHIVO TOKIO: ${tokyoStr} JST`;
    }
  }

  updateClocks();
  setInterval(updateClocks, 1000);
}

/* ==========================================================================
   2. SISTEMA DE MODAL PARA HACER OFERTA / CONSULTA DIRECTA
   ========================================================================== */
function initOfferModal() {
  const modalOverlay = document.getElementById('offerModalOverlay');
  if (!modalOverlay) return;

  const closeBtns = modalOverlay.querySelectorAll('[data-close-modal]');
  const form = document.getElementById('lapriestOfferForm');
  const feedbackPane = document.getElementById('offerFeedbackPane');
  const formPane = document.getElementById('offerFormPane');
  
  // Elementos dinámicos del dossier
  const dossierName = document.getElementById('dossierPieceName');
  const dossierCode = document.getElementById('dossierPieceCode');
  const dossierPrice = document.getElementById('dossierPiecePrice');
  
  // Inputs ocultos del formulario
  const inputTitle = document.getElementById('fieldPieceTitle');
  const inputCode = document.getElementById('fieldPieceCode');
  const inputPrice = document.getElementById('fieldPiecePrice');
  const inputId = document.getElementById('fieldPieceId');

  // Botones disparadores en todo el sitio
  const offerTriggers = document.querySelectorAll('.btn-make-offer, [data-action="make-offer"]');

  function openModal(data) {
    if (dossierName) dossierName.textContent = data.title || 'PIEZA DE ARCHIVO';
    if (dossierCode) dossierCode.textContent = data.code || 'LP-A-MEDIDA';
    if (dossierPrice) dossierPrice.textContent = data.price || 'BAJO CONSULTA';

    if (inputTitle) inputTitle.value = data.title || '';
    if (inputCode) inputCode.value = data.code || '';
    if (inputPrice) inputPrice.value = data.price || '';
    if (inputId) inputId.value = data.id || '';

    // Restablecer vista de formulario
    if (formPane) formPane.style.display = 'block';
    if (feedbackPane) feedbackPane.style.display = 'none';
    if (form) form.reset();

    updateReplyMethodVisuals();

    modalOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';

    // Foco en nombre
    setTimeout(() => {
      const nameInput = document.getElementById('clientFullName');
      if (nameInput) nameInput.focus();
    }, 200);
  }

  function closeModal() {
    modalOverlay.classList.remove('active');
    document.body.style.overflow = '';
  }

  offerTriggers.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const pieceData = {
        title: btn.getAttribute('data-piece-title') || 'SELECCIÓN DE PIEZA',
        code: btn.getAttribute('data-piece-code') || 'LP-REF',
        price: btn.getAttribute('data-piece-price') || 'A CONSULTAR',
        id: btn.getAttribute('data-piece-id') || '0',
      };
      openModal(pieceData);
    });
  });

  closeBtns.forEach(btn => {
    btn.addEventListener('click', closeModal);
  });

  modalOverlay.addEventListener('click', (e) => {
    if (e.target === modalOverlay) closeModal();
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modalOverlay.classList.contains('active')) {
      closeModal();
    }
  });

  // Selector de canal de respuesta
  const replyCards = modalOverlay.querySelectorAll('.reply-method-card');
  function updateReplyMethodVisuals() {
    replyCards.forEach(card => {
      const radio = card.querySelector('input[type="radio"]');
      if (radio && radio.checked) {
        card.classList.add('checked');
      } else {
        card.classList.remove('checked');
      }
    });
  }

  replyCards.forEach(card => {
    card.addEventListener('click', () => {
      const radio = card.querySelector('input[type="radio"]');
      if (radio) {
        radio.checked = true;
        updateReplyMethodVisuals();
      }
    });
  });

  // Envío del formulario por AJAX
  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const submitBtn = form.querySelector('.btn-submit-offer');
      const submitText = submitBtn.querySelector('span') || submitBtn;
      const originalText = submitText.textContent;
      submitBtn.disabled = true;
      submitText.textContent = (window.lapriest_data && window.lapriest_data.i18n) 
        ? window.lapriest_data.i18n.sending 
        : 'TRANSMITIENDO PROPUESTA AL ATELIER...';

      const formData = new FormData(form);

      // Si está corriendo dentro de WordPress
      if (window.lapriest_data && window.lapriest_data.ajax_url) {
        formData.append('action', 'lapriest_submit_offer');
        formData.append('security', window.lapriest_data.nonce);

        try {
          const res = await fetch(window.lapriest_data.ajax_url, {
            method: 'POST',
            body: formData
          });
          const result = await res.json();

          if (result.success) {
            renderSuccessState(result.data.reference_id, formData);
          } else {
            alert(result.data.message || 'Error al transmitir la propuesta. Por favor intente nuevamente.');
          }
        } catch (err) {
          console.error(err);
          alert('Error de conexión. Puede contactar directamente al atelier vía Instagram @lapriest_studio.');
        } finally {
          submitBtn.disabled = false;
          submitText.textContent = originalText;
        }
      } else {
        // Simulación en vista previa estática
        setTimeout(() => {
          submitBtn.disabled = false;
          submitText.textContent = originalText;
          const mockRef = 'LP-ACQ-' + Math.random().toString(36).substring(2, 8).toUpperCase();
          renderSuccessState(mockRef, formData);
        }, 700);
      }
    });
  }

  function renderSuccessState(refId, formData) {
    if (formPane) formPane.style.display = 'none';
    if (feedbackPane) {
      feedbackPane.style.display = 'block';

      const refDisplay = document.getElementById('receiptReferenceId');
      const pieceDisplay = document.getElementById('receiptPiece');
      const offerDisplay = document.getElementById('receiptOffer');
      const emailDisplay = document.getElementById('receiptClient');

      if (refDisplay) refDisplay.textContent = refId;
      if (pieceDisplay) pieceDisplay.textContent = `${formData.get('piece_title')} (${formData.get('piece_code')})`;
      if (offerDisplay) offerDisplay.textContent = `$${formData.get('proposed_offer')} USD`;
      if (emailDisplay) emailDisplay.textContent = formData.get('email');
    }
  }
}

/* ==========================================================================
   3. FILTRADO POR CATEGORÍAS DEL CATÁLOGO
   ========================================================================== */
function initCategoryFilters() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const pieceCards = document.querySelectorAll('.piece-card');
  const countEl = document.getElementById('catalogFilterCount');

  if (!filterBtns.length || !pieceCards.length) return;

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const category = btn.getAttribute('data-filter');

      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      let visibleCount = 0;

      pieceCards.forEach(card => {
        const cardCat = card.getAttribute('data-category');
        if (category === 'all' || cardCat === category) {
          card.style.display = 'flex';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      });

      if (countEl) {
        countEl.textContent = `MOSTRANDO ${visibleCount} DE ${pieceCards.length} PIEZAS DE ARCHIVO`;
      }
    });
  });
}

/* ==========================================================================
   4. ATMÓSFERA SONORA PROCEDURAL (DRONE ESTILO MUBI A 55Hz)
   ========================================================================== */
function initAmbientSoundscape() {
  const toggleBtn = document.getElementById('ambientToggle');
  if (!toggleBtn) return;

  let audioCtx = null;
  let masterGain = null;
  let isPlaying = false;
  let osc1 = null;
  let osc2 = null;

  function startAtmosphere() {
    if (!audioCtx) {
      const AudioContext = window.AudioContext || window.webkitAudioContext;
      audioCtx = new AudioContext();
    }

    if (audioCtx.state === 'suspended') {
      audioCtx.resume();
    }

    osc1 = audioCtx.createOscillator();
    osc1.type = 'sawtooth';
    osc1.frequency.setValueAtTime(55, audioCtx.currentTime);

    osc2 = audioCtx.createOscillator();
    osc2.type = 'sine';
    osc2.frequency.setValueAtTime(82.4, audioCtx.currentTime);

    const filter = audioCtx.createBiquadFilter();
    filter.type = 'lowpass';
    filter.frequency.setValueAtTime(140, audioCtx.currentTime);
    filter.Q.setValueAtTime(3.5, audioCtx.currentTime);

    masterGain = audioCtx.createGain();
    masterGain.gain.setValueAtTime(0.001, audioCtx.currentTime);
    masterGain.gain.exponentialRampToValueAtTime(0.12, audioCtx.currentTime + 3);

    osc1.connect(filter);
    osc2.connect(filter);
    filter.connect(masterGain);
    masterGain.connect(audioCtx.destination);

    osc1.start();
    osc2.start();
    isPlaying = true;

    toggleBtn.classList.add('active');
    const label = toggleBtn.querySelector('.audio-status');
    if (label) label.textContent = 'ATMÓSFERA: 55Hz NOCTURNO';
  }

  function stopAtmosphere() {
    if (masterGain && audioCtx) {
      masterGain.gain.setValueAtTime(masterGain.gain.value, audioCtx.currentTime);
      masterGain.gain.exponentialRampToValueAtTime(0.0001, audioCtx.currentTime + 1.5);
      setTimeout(() => {
        if (osc1) osc1.stop();
        if (osc2) osc2.stop();
        isPlaying = false;
        toggleBtn.classList.remove('active');
        const label = toggleBtn.querySelector('.audio-status');
        if (label) label.textContent = 'ATMÓSFERA: DESACTIVADA';
      }, 1500);
    }
  }

  toggleBtn.addEventListener('click', () => {
    if (isPlaying) {
      stopAtmosphere();
    } else {
      startAtmosphere();
    }
  });
}

/* ==========================================================================
   5. MENÚ MÓVIL
   ========================================================================== */
function initMobileNav() {
  const toggle = document.querySelector('.mobile-nav-toggle');
  const navMenu = document.querySelector('.nav-menu');

  if (toggle && navMenu) {
    toggle.addEventListener('click', () => {
      navMenu.classList.toggle('open');
      toggle.textContent = navMenu.classList.contains('open') ? '[ CERRAR ]' : '[ MENÚ ]';
    });

    navMenu.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', () => {
        navMenu.classList.remove('open');
        toggle.textContent = '[ MENÚ ]';
      });
    });
  }
}

/* ==========================================================================
   6. PRECARGA DE IMÁGENES AL PASAR EL CURSOR
   ========================================================================== */
function initImageHoverPreload() {
  const hoverImages = document.querySelectorAll('.piece-img-hover');
  hoverImages.forEach(img => {
    if (img.src) {
      const preload = new Image();
      preload.src = img.src;
    }
  });
}

/* ==========================================================================
   7. CONTROLADOR DE VERSIONES TIPOGRÁFICAS Y MODO CAPTURA
   ========================================================================== */
function initTypographySwitcher() {
  const switcherBar = document.querySelector('.typography-switcher-bar');
  if (switcherBar) {
    document.body.classList.add('has-switcher');
  }

  // Botón para ocultar/mostrar la barra y capturar la web limpia
  const toggleCleanBtn = document.querySelector('[data-toggle-clean]');
  const restoreBtn = document.querySelector('.restore-switcher-pill');

  function enableCleanMode() {
    document.body.classList.add('clean-screenshot-mode');
  }

  function disableCleanMode() {
    document.body.classList.remove('clean-screenshot-mode');
  }

  if (toggleCleanBtn) {
    toggleCleanBtn.addEventListener('click', (e) => {
      e.preventDefault();
      enableCleanMode();
    });
  }

  if (restoreBtn) {
    restoreBtn.addEventListener('click', (e) => {
      e.preventDefault();
      disableCleanMode();
    });
  }

  // Tecla 'C' o 'Escape' para activar/desactivar modo captura limpia rápidamente
  document.addEventListener('keydown', (e) => {
    if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
    if (e.key === 'c' || e.key === 'C') {
      if (document.body.classList.contains('clean-screenshot-mode')) {
        disableCleanMode();
      } else {
        enableCleanMode();
      }
    }
    if (e.key === 'Escape' && document.body.classList.contains('clean-screenshot-mode')) {
      disableCleanMode();
    }
  });
}
