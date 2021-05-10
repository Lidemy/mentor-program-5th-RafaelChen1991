
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

function whichIsBigger(a, b) {
  for (let i = 0; i < a.length; i++) {
    if (Number(a[i]) > Number(b[i])) {
      return 'a'
    } else if (Number(a[i]) < Number(b[i])) {
      return 'b'
    }
  } return 'draw'
}

function solve(lines) {
  const arr = []
  for (let i = 0; i < lines.length; i++) {
    arr.push(lines[i].split(' '))
  }

  for (let i = 1; i < arr.length; i++) {
    const a = arr[i][0]
    const b = arr[i][1]
    const c = Number(arr[i][2])
    if (((a.length > b.length) && (c === 1)) || ((a.length < b.length) && (c === -1))) {
      console.log('A')
    } else if (((a.length < b.length) && (c === 1)) || ((a.length > b.length) && (c === -1))) {
      console.log('B')
    } else if (whichIsBigger(a, b) === 'draw') {
      console.log('DRAW')
    } else if (((whichIsBigger(a, b) === 'a') && (c === 1)) || ((whichIsBigger(a, b) === 'b') && (c === -1))) {
      console.log('A')
    } else if (((whichIsBigger(a, b) === 'a') && (c === -1)) || ((whichIsBigger(a, b) === 'b') && (c === 1))) {
      console.log('B')
    }
  }
}
