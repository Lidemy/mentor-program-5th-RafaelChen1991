// A:65 Z:90 a:97 z:122 A-a:32
function capitalize(str) {
    var new_str = str.split('')
    if (str[0].charCodeAt() >= 97 && str[0].charCodeAt() <= 122){
        new_str[0] = str[0].toUpperCase()
        new_str = new_str.join('')
        return new_str
    }
    return str
}

console.log(capitalize('hello'));

