// Firebase v10 Modular SDK Configuration
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
import { getFirestore } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-firestore.js";
import { getAuth } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-auth.js";

const firebaseConfig = {
    apiKey: "AIzaSyCV2fKizQPM6yHVhCu-i8XdL34StPcHK7c",
    authDomain: "actechnician-6ab0b.firebaseapp.com",
    projectId: "actechnician-6ab0b",
    storageBucket: "actechnician-6ab0b.firebasestorage.app",
    messagingSenderId: "872947613971",
    appId: "1:872947613971:web:7ce7a30b373040eaf15ae6",
    measurementId: "G-3ZH8JRSPZB"
  };

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const db = getFirestore(app);
const auth = getAuth(app);

export { db, auth };
