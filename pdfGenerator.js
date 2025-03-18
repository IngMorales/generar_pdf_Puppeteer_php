// pdfGenerator.js
const puppeteer = require('puppeteer');

(async () => {
  try {
    // Inicia el navegador en modo headless
    const browser = await puppeteer.launch();
    const page = await browser.newPage();

    // Asegúrate de que tu servidor Apache esté corriendo y la URL sea accesible.
    await page.goto('http://localhost/index.php', { waitUntil: 'networkidle0' });

    // Opciones para generar el PDF
    await page.pdf({
      path: 'reporte.pdf',  // Archivo de salida
      format: 'A4',
      printBackground: true
    });

    await browser.close();
    console.log('PDF generado exitosamente.');
  } catch (error) {
    console.error('Error al generar el PDF:', error);
    process.exit(1);
  }
})();
