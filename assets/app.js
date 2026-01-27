import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
/**
 * Fichiers CSS spécifiques chargés
 */
import './styles/app.css';

/**
 * Fichiers JS spécifiques chargés
 */
import './js/select.js';

/**
 * Turbo fait de la merde sur du chargement dynamique de sélect multiple.
 * Je désactive
 */
import * as Turbo from '@hotwired/turbo'
Turbo.session.drive = false;

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
