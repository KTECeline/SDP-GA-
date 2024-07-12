const express = require('./vercel/node_modules/express');
const phpExpress = require('./vercel/node_modules/express/php-express')({
  binPath: 'C:/xampp1/php/php.exe' // replace with your PHP binary path if different
});

const app = express();
app.set('views', './');
app.engine('php', phpExpress.engine);
app.set('view engine', 'php');

app.use(express.static(__dirname));
app.all(/.+\.php$/, phpExpress.router);

const port = process.env.PORT || 3000;
app.listen(port, () => {
  console.log(`Server running on port ${port}`);
});
