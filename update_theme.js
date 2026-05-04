const fs = require('fs');
const path = require('path');

const dir = __dirname;
const files = fs.readdirSync(dir).filter(f => f.endsWith('.html'));

for (const file of files) {
    const filePath = path.join(dir, file);
    let html = fs.readFileSync(filePath, 'utf8');

    // Add font if not present
    if (!html.includes('fonts.googleapis.com/css2?family=Outfit')) {
        html = html.replace(/<head>/i, `<head>\n    <link rel="preconnect" href="https://fonts.googleapis.com">\n    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>\n    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">\n    <style>\n        body { font-family: 'Outfit', sans-serif; }\n    </style>`);
    }

    // Body
    html = html.replace(/<body class="bg-gray-100">/ig, '<body class="bg-slate-50 text-slate-800">');

    // Text colors
    html = html.replace(/text-blue-800/g, 'text-red-700');
    html = html.replace(/text-blue-600/g, 'text-red-600');
    html = html.replace(/text-blue-200/g, 'text-slate-400');
    html = html.replace(/text-blue-700/g, 'text-red-700');

    // Background colors
    html = html.replace(/bg-blue-700/g, 'bg-slate-900');
    html = html.replace(/bg-blue-800/g, 'bg-slate-950');
    html = html.replace(/bg-blue-600/g, 'bg-red-600');
    html = html.replace(/bg-blue-100/g, 'bg-red-50');
    
    // Hover and Borders
    html = html.replace(/hover:bg-blue-800/g, 'hover:bg-red-700');
    html = html.replace(/hover:text-blue-800/g, 'hover:text-red-700');
    html = html.replace(/hover:text-blue-200/g, 'hover:text-white');
    html = html.replace(/border-blue-600/g, 'border-slate-800');
    html = html.replace(/border-blue-700/g, 'border-slate-800');

    // Gradients
    html = html.replace(/from-blue-800 to-blue-600/g, 'from-slate-900 to-red-700');
    html = html.replace(/bg-gradient-to-r from-blue-50 to-gray-50/g, 'bg-gradient-to-r from-slate-100 to-slate-200');
    html = html.replace(/bg-gradient-to-br from-blue-50 to-gray-100/g, 'bg-gradient-to-br from-slate-50 to-slate-100');

    // Shadows
    html = html.replace(/shadow-lg/g, 'shadow-[0_8px_30px_rgb(0,0,0,0.12)]');

    fs.writeFileSync(filePath, html, 'utf8');
}
console.log('Theme updated successfully across all HTML files.');
