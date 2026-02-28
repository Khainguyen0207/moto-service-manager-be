import Popper from '@popperjs/core/dist/umd/popper.min';




try {
  window.Popper = Popper;
} catch (e) {}

export { Popper };
