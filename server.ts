import express from 'express';
import path from 'path';
import fs from 'fs';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();
const PORT = 3000;

app.use(express.json());

// Serve static files
app.use(express.static(path.join(__dirname, '.')));
app.use('/assets', express.static(path.join(__dirname, 'assets')));
app.use('/css', express.static(path.join(__dirname, 'css')));
app.use('/js', express.static(path.join(__dirname, 'js')));
app.use('/uploads', express.static(path.join(__dirname, 'uploads')));

// Mock Database path
const DB_PATH = path.join(__dirname, 'database', 'db.json');

// Initialize Mock DB if it doesn't exist
if (!fs.existsSync(DB_PATH)) {
  const initialData = {
    menu: [
      { id: 1, name: 'Traditional Maithili Thali', price: 450, category: 'Special Thali', description: 'Authentic assortment of curries, rice, and Mithila specialties.', image: '/src/assets/images/maithili_thali_special_1783778191548.jpg', popular: true, chefSpecial: true, veg: true },
      { id: 2, name: 'Siddharth Thali', price: 350, category: 'Veg', description: 'Premium vegetarian meal with seasonal vegetables.', image: '/src/assets/images/maithili_thali_special_1783778191548.jpg', popular: false, chefSpecial: false, veg: true },
      { id: 3, name: 'Janakpur Special Fish', price: 300, category: 'Non Veg', description: 'Fresh river fish cooked in authentic mustard sauce.', image: '/src/assets/images/maithili_thali_special_1783778191548.jpg', popular: true, chefSpecial: true, veg: false }
    ],
    reservations: [],
    orders: [],
    settings: {
      restaurantName: 'Maithil Thal',
      tagline: 'Experience Authentic Maithili Cuisine in Janakpur',
      phone: '9709171500',
      whatsapp: '9709171500',
      hours: 'Open Daily - Close 10 PM'
    }
  };
  fs.mkdirSync(path.dirname(DB_PATH), { recursive: true });
  fs.writeFileSync(DB_PATH, JSON.stringify(initialData, null, 2));
}

// API Routes
app.get('/api/menu', (req, res) => {
  const data = JSON.parse(fs.readFileSync(DB_PATH, 'utf-8'));
  res.json(data.menu);
});

app.get('/api/settings', (req, res) => {
  const data = JSON.parse(fs.readFileSync(DB_PATH, 'utf-8'));
  res.json(data.settings);
});

app.post('/api/reserve', (req, res) => {
  const data = JSON.parse(fs.readFileSync(DB_PATH, 'utf-8'));
  const newReservation = { ...req.body, id: Date.now() };
  data.reservations.push(newReservation);
  fs.writeFileSync(DB_PATH, JSON.stringify(data, null, 2));
  res.status(201).json({ success: true, message: 'Reservation received!' });
});

// Serve index.html for any unknown route (SPA-like or just direct index)
app.get('*', (req, res) => {
  res.sendFile(path.join(__dirname, 'index.html'));
});

app.listen(PORT, '0.0.0.0', () => {
  console.log(`Server running at http://localhost:${PORT}`);
});
