
document.addEventListener('DOMContentLoaded', () => {
  // Inicializar tooltips
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.forEach((tooltipTriggerEl) => {
      new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Asegurarse de que los dropdowns funcionan
  const dropdownElements = document.querySelectorAll('.dropdown-toggle');
  dropdownElements.forEach((dropdownEl) => {
      new bootstrap.Dropdown(dropdownEl);
  });
});
