import { initializeApp } from 'firebase/app';

// TODO: Replace the following with your app's Firebase project configuration
const firebaseConfig = {
    apiKey: "AIzaSyA-zgpR3XTUYHPobIMMY-Ij4PLfWpcafSQ",
    authDomain: "phishingterminator.firebaseapp.com",
    projectId: "phishingterminator",
    storageBucket: "phishingterminator.appspot.com",
    messagingSenderId: "340832260",
    appId: "1:340832260:web:9517498dca71e0b8688551",
    measurementId: "G-92ET8ZGSQS"
  };

const firebaseApp = initializeApp(firebaseConfig);

export default firebaseApp