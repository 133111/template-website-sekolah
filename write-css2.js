const fs = require('fs');

const css = [
  '/* macOS Traffic Light Bullets - Pure CSS approach */',
  '',
  '/* 3 traffic light dots using box-shadow trick */',
  'body::before {',
  '    content: "" !important;',
  '    position: fixed !important;',
  '    top: 10px !important;',
  '    left: 14px !important;',
  '    width: 13px !important;',
  '    height: 13px !important;',
  '    border-radius: 50% !important;',
  '    background-color: #ff5f57 !important;',
  '    box-shadow:',
  '        20px 0 0 0 #ffbd2e,',
  '        40px 0 0 0 #28c840,',
  '        0 0 0 0.5px rgba(0,0,0,0.12),',
  '        20px 0 0 0.5px rgba(0,0,0,0.12),',
  '        40px 0 0 0.5px rgba(0,0,0,0.12) !important;',
  '    z-index: 2147483647 !important;',
  '    pointer-events: none !important;',
  '    display: block !important;',
  '}',
].join('\n');

fs.writeFileSync('C:\\\\Code\\\\WEBSITE\\\\mac-style.css', css, 'utf8');
console.log('CSS file updated!');