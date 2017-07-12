let path = require('path'),
    webpack = require('webpack'),
    CommonsChunkPlugin = require('./node_modules/webpack/lib/optimize/CommonsChunkPlugin'),
    ExtractTextPlugin = require('extract-text-webpack-plugin');


module.exports = {
	entry: {
		filename: './src/babel/main.js'
  },
	output: {
	  path: path.resolve(__dirname, ''),
	  filename: "js/script.js"
	},
	devServer: {
		inline: true,
		contentBase: 'static-templates',
		port: 3000
	},
  module: {
    rules: [{
			        test: /\.scss$/,
			        include: [path.resolve(__dirname, 'src/sass')],
			        use: ExtractTextPlugin.extract({
			        	use: [
			        	{
			        		loader: 'css-loader',
			        		options: { url: false, importLoaders: 1 }
			        	},
			        	{
			        		loader: 'postcss-loader'
			        	},
			        	{
			        		loader: 'sass-loader'
			        	},
			        	],
			          fallback: 'style-loader'
			        })
			      },
			    	 {
			        test: /\.js?$/,
			        exclude: /(node_modules|bower_components)/,
			        loader: 'babel-loader'
			      }]
  },
  plugins: [
    new ExtractTextPlugin('css/style.css')
  ]
};