import './bootstrap.js';
/*
 * Bienvenue dans le fichier JavaScript principal de votre application !
 *
 * Ce fichier sera inclus dans la page via la fonction Twig importmap(),
 * qui devrait déjà être présente dans votre fichier base.html.twig.
 */
import './styles/app.css';

// Importation du fichier duck.js
import Duck from './duck.js';
const duck = new Duck('Waddles');
duck.quack();

console.log('Ce message vient de assets/app.js - bienvenue dans AssetMapper !🎉');
import hljs from 'highlight.js/lib/core';
import javascript from 'highlight.js/lib/languages/javascript';

hljs.registerLanguage('javascript', javascript);
hljs.highlightAll();


