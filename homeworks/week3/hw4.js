
const readline = require('readline')

const rl = readline.createInterface({
  input: process.stdin
})

const lines = []
rl.on('line', (line) => {
  lines.push(line)
})

rl.on('close', () => {
  solve(lines)
})

function reverse(n) {
  let result = ''
  for (let i = n.length - 1; i >= 0; i--) {
    result += n[i]
  }
  return result
}

function solve(lines) {
  const str = lines[0]
  if (str === reverse(str)) {
    console.log('True')
  } else {
    console.log('False')
  }
}
