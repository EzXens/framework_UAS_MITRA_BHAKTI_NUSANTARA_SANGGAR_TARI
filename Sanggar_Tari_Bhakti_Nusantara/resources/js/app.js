import './bootstrap';
import { TutorialSystem } from './tutorial';
import { tutorialData } from './tutorial-data';

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Tutorial System
    window.tutorialSystem = new TutorialSystem(tutorialData);
});
