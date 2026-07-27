// resources/js/components/index.js

import './mega-menu';

import { initCountdowns } from './countdown';
import { initEmbla } from './embla';
import { initProductGallery } from './product-gallery';

function initComponents() {
    initCountdowns();
    initEmbla();
    initProductGallery();
}

document.addEventListener('DOMContentLoaded', initComponents);
document.addEventListener('livewire:navigated', initComponents);