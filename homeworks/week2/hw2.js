// A:65 Z:90 a:97 z:122 A-a:32
function capitalize(str) {
    var newStr = str.split('')
    if (str[0].charCodeAt() >= 97 && str[0].charCodeAt() <= 122){
        newStr[0] = str[0].toUpperCase()
        newStr = newStr.join('')
    } else{
        newStr = str
    }
    return newStr
}

console.log(capitalize('hello'));
