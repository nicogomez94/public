(function () {
  const $ = (selector, scope = document) => scope.querySelector(selector);
  const $$ = (selector, scope = document) => Array.from(scope.querySelectorAll(selector));

  const menu = $('.mobile-menu');
  const menuToggle = $('.menu-toggle');
  const panelBusqueda = $('.search-panel');
  const inputBusqueda = $('#globalSearch');
  const resultados = $('#searchResults');
  const modalQr = $('#qrRecetarioModal');
  const botonQr = $('.recipe-qr-trigger');
  const productos = window.pachaDatos?.productos || [];
  let focoAnteriorQr = null;

  function cerrarBusqueda() {
    if (!panelBusqueda) return;
    panelBusqueda.classList.remove('open');
    panelBusqueda.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('no-scroll');
  }

  function mostrarToast(mensaje) {
    const toast = $('.toast');
    if (!toast) return;
    $('span', toast).textContent = mensaje;
    toast.classList.add('show');
    clearTimeout(mostrarToast.timer);
    mostrarToast.timer = setTimeout(() => toast.classList.remove('show'), 2600);
  }

  function abrirModalQr() {
    if (!modalQr) return;
    focoAnteriorQr = document.activeElement;
    modalQr.classList.add('open');
    modalQr.setAttribute('aria-hidden', 'false');
    document.body.classList.add('no-scroll');
    $('.qr-modal-content', modalQr)?.focus();
  }

  function cerrarModalQr() {
    if (!modalQr?.classList.contains('open')) return;
    modalQr.classList.remove('open');
    modalQr.setAttribute('aria-hidden', 'true');
    if (!panelBusqueda?.classList.contains('open')) document.body.classList.remove('no-scroll');
    focoAnteriorQr?.focus();
  }

  if (menuToggle && menu) {
    menuToggle.addEventListener('click', () => {
      const abierto = menu.classList.toggle('open');
      menuToggle.setAttribute('aria-expanded', abierto ? 'true' : 'false');
    });
  }

  $('.search-trigger')?.addEventListener('click', () => {
    panelBusqueda?.classList.add('open');
    panelBusqueda?.setAttribute('aria-hidden', 'false');
    document.body.classList.add('no-scroll');
    setTimeout(() => inputBusqueda?.focus(), 220);
  });

  $('.search-close')?.addEventListener('click', cerrarBusqueda);

  botonQr?.addEventListener('click', abrirModalQr);
  $$('[data-qr-close]').forEach((boton) => boton.addEventListener('click', cerrarModalQr));

  inputBusqueda?.addEventListener('input', (event) => {
    const consulta = event.target.value.trim().toLowerCase();
    const encontrados = consulta
      ? productos.filter((producto) => `${producto.nombre} ${producto.descripcion}`.toLowerCase().includes(consulta))
      : [];

    if (!resultados) return;
    if (!consulta) {
      resultados.innerHTML = '<p>Buscá por producto o característica.</p>';
      return;
    }
    resultados.innerHTML = encontrados.length
      ? encontrados.map((producto) => `<a class="search-result" href="${producto.url}"><b>${producto.nombre}</b><span>Ver producto <i class="fa-solid fa-arrow-right"></i></span></a>`).join('')
      : `<p>No encontramos resultados para "${event.target.value}".</p>`;
  });

  document.addEventListener('keydown', (event) => {
    if (event.key !== 'Escape') return;
    cerrarModalQr();
    cerrarBusqueda();
  });

  $$('[data-scroll]').forEach((boton) => {
    boton.addEventListener('click', (event) => {
      const destino = document.getElementById(boton.dataset.scroll);
      if (!destino) return;
      event.preventDefault();
      destino.scrollIntoView({ behavior: 'smooth' });
    });
  });

  const observador = 'IntersectionObserver' in window
    ? new IntersectionObserver((entradas) => {
        entradas.forEach((entrada) => {
          if (!entrada.isIntersecting) return;
          entrada.target.classList.add('visible');
          observador.unobserve(entrada.target);
        });
      }, { threshold: 0.08 })
    : null;

  $$('.fade-in').forEach((elemento) => {
    if (observador) observador.observe(elemento);
    else elemento.classList.add('visible');
  });

  window.addEventListener('scroll', () => {
    $('.site-header')?.classList.toggle('scrolled', window.scrollY > 30);
  }, { passive: true });

  document.body.addEventListener('added_to_cart', () => mostrarToast('Producto agregado al carrito'));
})();
