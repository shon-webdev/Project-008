<?php
/**
 * Parte de Plantilla: Sistema de Modal de Oferta
 * Propuesta de Adquisición Directa Personalizada LAPRIEST
 *
 * @package LAPRIEST
 */
?>

<!-- Modal de Adquisición Directa / Hacer una Oferta -->
<div class="offer-modal-overlay" id="offerModalOverlay" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
  <div class="offer-modal-window">
    
    <!-- Encabezado del Modal -->
    <div class="modal-header-bar">
      <div class="modal-header-title" id="modalTitle">
        // PROPONER ADQUISICIÓN / CONSULTAR
      </div>
      <button type="button" class="modal-close-btn" data-close-modal aria-label="<?php esc_attr_e('Cerrar Ventana', 'lapriest'); ?>">&times;</button>
    </div>

    <!-- Dossier de la Prenda Objetivo (Dinámico) -->
    <div class="modal-piece-dossier">
      <div>
        <div class="dossier-piece-name" id="dossierPieceName">PIEZA 01: CAFTÁN DRAPEADO OBSIDIANA</div>
        <div class="dossier-meta-code" id="dossierPieceCode">LP-FW26-001 // A MEDIDA</div>
      </div>
      <div class="dossier-baseline">
        <div style="font-size:0.5625rem; letter-spacing:0.18em; text-transform:uppercase; color:#777;">VALOR BASE</div>
        <div class="dossier-baseline-val" id="dossierPiecePrice">$1,850 USD</div>
      </div>
    </div>

    <!-- Vista del Formulario Activo -->
    <div class="offer-form-container" id="offerFormPane">
      <form id="lapriestOfferForm" class="offer-form" novalidate>
        
        <!-- Campos Ocultos Dinámicos -->
        <input type="hidden" name="piece_title" id="fieldPieceTitle" value="">
        <input type="hidden" name="piece_code" id="fieldPieceCode" value="">
        <input type="hidden" name="piece_baseline" id="fieldPiecePrice" value="">
        <input type="hidden" name="piece_id" id="fieldPieceId" value="">

        <div class="form-grid-2">
          <div class="form-field-group">
            <label class="form-label" for="clientFullName"><?php esc_html_e('Nombre Completo', 'lapriest'); ?> <span class="req">*</span></label>
            <input type="text" id="clientFullName" name="full_name" class="form-input" placeholder="Ej: Julián Vane" required>
          </div>
          <div class="form-field-group">
            <label class="form-label" for="clientEmail"><?php esc_html_e('Correo Electrónico', 'lapriest'); ?> <span class="req">*</span></label>
            <input type="email" id="clientEmail" name="email" class="form-input" placeholder="julian@archivo.com" required>
          </div>
        </div>

        <div class="form-grid-2">
          <div class="form-field-group">
            <label class="form-label" for="clientInstagram"><?php esc_html_e('Cuenta de Instagram', 'lapriest'); ?> <span style="color:#666;">(OPCIONAL)</span></label>
            <input type="text" id="clientInstagram" name="instagram" class="form-input" placeholder="@tuusuario">
          </div>
          <div class="form-field-group">
            <label class="form-label" for="clientOfferAmount"><?php esc_html_e('Oferta Propuesta ($ USD)', 'lapriest'); ?> <span class="req">*</span></label>
            <div class="offer-amount-wrapper">
              <span class="offer-amount-prefix">$</span>
              <input type="number" id="clientOfferAmount" name="proposed_offer" class="form-input form-input-offer" placeholder="1850" min="1" step="1" required>
            </div>
          </div>
        </div>

        <!-- Protocolo de Respuesta Preferido -->
        <div class="form-field-group">
          <label class="form-label"><?php esc_html_e('Canal de Respuesta Preferido', 'lapriest'); ?></label>
          <div class="reply-selector-group">
            <div class="reply-method-card checked">
              <input type="radio" id="replyEmail" name="reply_method" value="Correo Electrónico" checked>
              <label for="replyEmail"><?php esc_html_e('Correo Confidencial', 'lapriest'); ?></label>
            </div>
            <div class="reply-method-card">
              <input type="radio" id="replyInstagram" name="reply_method" value="Instagram DM">
              <label for="replyInstagram"><?php esc_html_e('Mensaje Directo (DM)', 'lapriest'); ?></label>
            </div>
          </div>
        </div>

        <!-- Mensaje / Medidas -->
        <div class="form-field-group">
          <label class="form-label" for="clientMessage"><?php esc_html_e('Medidas o Consultas Especiales', 'lapriest'); ?> <span style="color:#666;">(OPCIONAL)</span></label>
          <textarea id="clientMessage" name="message" class="form-textarea" rows="3" placeholder="<?php esc_attr_e('Indique notas sobre medidas personalizadas, solicitud de cita privada o país de entrega...', 'lapriest'); ?>"></textarea>
        </div>

        <!-- Botón de Transmisión -->
        <button type="submit" class="btn-submit-offer">
          <span><?php esc_html_e('ENVIAR PROPUESTA AL ATELIER', 'lapriest'); ?> &rarr;</span>
        </button>

        <p class="modal-legal-note">
          <?php esc_html_e('LAPRIEST opera sin carritos de compra convencionales. Cada propuesta es evaluada de manera personalizada por la dirección del atelier. No se procesa ningún cobro en esta etapa.', 'lapriest'); ?>
        </p>
      </form>
    </div>

    <!-- Vista de Confirmación y Recibo -->
    <div class="modal-feedback-pane" id="offerFeedbackPane">
      <div class="feedback-status-badge">// TRANSMISIÓN CONFIRMADA</div>
      <h2 class="feedback-title"><?php esc_html_e('OFERTA REGISTRADA', 'lapriest'); ?></h2>
      <p style="font-size:0.875rem; color:#888; max-width:440px; margin:0 auto 1.5rem; line-height:1.6;">
        <?php esc_html_e('Su propuesta ha sido ingresada en el registro privado de adquisiciones del atelier LAPRIEST. Recibirá una respuesta privada en un plazo máximo de 24 horas.', 'lapriest'); ?>
      </p>

      <div class="feedback-receipt-box">
        <div class="receipt-row">
          <span style="color:#777;"><?php esc_html_e('REF. DE DOSSIER DE ADQUISICIÓN:', 'lapriest'); ?></span>
          <strong id="receiptReferenceId" style="color:#fff; font-family:monospace; letter-spacing:1px;">LP-ACQ-00000</strong>
        </div>
        <div class="receipt-row">
          <span style="color:#777;"><?php esc_html_e('PRENDA OBJETIVO:', 'lapriest'); ?></span>
          <span id="receiptPiece" style="color:#ddd;">—</span>
        </div>
        <div class="receipt-row">
          <span style="color:#777;"><?php esc_html_e('OFERTA PROPUESTA:', 'lapriest'); ?></span>
          <strong id="receiptOffer" style="color:#fff;">$0 USD</strong>
        </div>
        <div class="receipt-row">
          <span style="color:#777;"><?php esc_html_e('CANAL DE CONTACTO:', 'lapriest'); ?></span>
          <span id="receiptClient" style="color:#ddd;">—</span>
        </div>
      </div>

      <button type="button" class="btn-submit-offer" data-close-modal style="background:transparent; border-color:#444; color:#fff;">
        <span><?php esc_html_e('VOLVER AL CATÁLOGO', 'lapriest'); ?></span>
      </button>
    </div>

  </div>
</div>
