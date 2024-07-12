const express = require('express');
const phpExpress = require('php-express')({
  binPath: 'php' // replace with your PHP binary path if different
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
