document.querySelectorAll('.navbar-collapse .nav-link, .navbar-collapse .btn').forEach((link) => {
  link.addEventListener('click', () => {
    const nav = document.querySelector('.navbar-collapse.show');
    if (!nav) return;

    bootstrap.Collapse.getOrCreateInstance(nav).hide();
  });
});

const phoneInput = document.getElementById('telefone');

if (phoneInput) {
  const formatPhone = (value) => {
    const digits = value.replace(/\D/g, '').slice(0, 11);

    if (digits.length <= 2) return digits.replace(/^(\d{0,2})/, '($1');
    if (digits.length <= 6) return digits.replace(/^(\d{2})(\d{0,4})/, '($1) $2');
    if (digits.length <= 10) return digits.replace(/^(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');

    return digits.replace(/^(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
  };

  phoneInput.addEventListener('input', () => {
    phoneInput.value = formatPhone(phoneInput.value);
  });
}

const productModalElement = document.getElementById('productModal');

if (productModalElement) {
  const productModal = bootstrap.Modal.getOrCreateInstance(productModalElement);
  const productModalTitle = document.getElementById('productModalTitle');
  const productModalImage = document.getElementById('productModalImage');
  const productModalDescription = document.getElementById('productModalDescription');
  const productQuoteLink = productModalElement.querySelector('.product-quote-link');

  const openProductModal = (card) => {
    productModalTitle.textContent = card.dataset.productTitle;
    productModalImage.src = card.dataset.productImage;
    productModalImage.alt = card.dataset.productTitle;
    productModalDescription.textContent = card.dataset.productDescription;
    productModal.show();
  };

  document.querySelectorAll('.product-card').forEach((card) => {
    card.addEventListener('click', () => openProductModal(card));
    card.addEventListener('keydown', (event) => {
      if (event.key !== 'Enter' && event.key !== ' ') return;

      event.preventDefault();
      openProductModal(card);
    });
  });

  productQuoteLink.addEventListener('click', (event) => {
    event.preventDefault();
    productModal.hide();

    productModalElement.addEventListener('hidden.bs.modal', () => {
      document.getElementById('contato').scrollIntoView({ behavior: 'smooth' });
      history.replaceState(null, '', '#contato');
    }, { once: true });
  });
}
