function reverse(str) {
    var ns =""
    for (var i = str.length-1; i >= 0; i--){
        ns += str[i]
    }
    console.log(ns)  
}

reverse('hello');
