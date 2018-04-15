String.prototype.format = function() {
	var result = this.split("").join(""),
	reg = /\{\d*\}/g,
	res = reg.exec(result);
	if(res) {
		for(var i = 0; i < arguments.length; i++) {
			var n = i;
			result = result.replace(eval('/\\{' + i + '\\}/g'), arguments[i]);
		}
	}
	//replace()中的正则加变量必须转换，否则使用new RegExp()创建； /\{' + i + '\}/g只能解析为｛0｝，而不是字符串'{0}';
	return result;
}