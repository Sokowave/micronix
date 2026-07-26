// resources/js/components/index.js

import './mega-menu';

import { initEmbla } from './embla';
import { initProductGallery } from './product-gallery';

function initComponents() {
    initEmbla();
    initProductGallery();
}

document.addEventListener('DOMContentLoaded', initComponents);
document.addEventListener('livewire:navigated', initComponents);