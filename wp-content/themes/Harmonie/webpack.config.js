
const path = require('path');
const webpack = require('webpack');

const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const cssnano = require('cssnano');
const postcssPresetEnv = require('postcss-preset-env');

const JS_DIR = path.resolve(__dirname, 'src');
const BUILD_DIR = path.resolve(__dirname, 'build');


const entry = {
    // JavaScript Files
    home: JS_DIR + '/js/scripts/home.js',
    cart: JS_DIR + '/js/scripts/cart.js',
    checkout: JS_DIR + '/js/scripts/checkout.js',
    faq: JS_DIR + '/js/scripts/faq.js',
    header: JS_DIR + '/js/scripts/header.js',
    product: JS_DIR + '/js/scripts/product.js',
    shop: JS_DIR + '/js/scripts/shop.js',
    wishlist: JS_DIR + '/js/scripts/wishlist.js',

    // JavaScript Plugins Files
    pluginHeader: JS_DIR + '/p-header.js',
    pluginHome: JS_DIR + '/p-home.js',
    pluginProduct: JS_DIR + '/p-product.js',
    pluginShop: JS_DIR + '/p-shop.js',
    pluginWishlist: JS_DIR + '/p-wishlist.js',

    // CSS Files
    404: JS_DIR + '/css/404.js',
    aboutUsSt: JS_DIR + '/css/about-us.js',
    cartSt: JS_DIR + '/css/cart.js',
    checkoutSt: JS_DIR + '/css/checkout.js',
    contactUsSt: JS_DIR + '/css/contact-us.js',
    faqSt: JS_DIR + '/css/faq.js',
    globalSt: JS_DIR + '/css/global.js',
    headerSt: JS_DIR + '/css/header.js',
    homeSt: JS_DIR + '/css/home.js',
    loginSt: JS_DIR + '/css/login.js',
    myAccountSt: JS_DIR + '/css/my-account.js',
    productSt: JS_DIR + '/css/product.js',
    servicesSt: JS_DIR + '/css/service.js',
    shopSt: JS_DIR + '/css/shop.js',
    wishlistSt: JS_DIR + '/css/wishlist.js',
    responsive: JS_DIR + '/css/responsive.js',
    terms: JS_DIR + '/css/terms.js',
    // styles: JS_DIR + '/mainstyles.js',

    // CSS Plugins Files
    globalStylePlug: JS_DIR + '/css/css-plugins/global.js',
    homeStylePlug: JS_DIR + '/css/css-plugins/home.js',
    productStylePlug: JS_DIR + '/css/css-plugins/product.js',
    shopStylePlug: JS_DIR + '/css/css-plugins/shop.js',
    wishlistStylePlug: JS_DIR + '/css/css-plugins/wishlist',

    // stylesPluginsSt: JS_DIR + '/stylesplugins.js',
}
const output = {
    path: BUILD_DIR,
    filename: '[name].js'
}
const rules = [
    {
        test: /\.js$/,
        include: JS_DIR,
        exclude: /node_modules/,
        use: 'babel-loader',

    },
    {
        test: /\.css$/,
        exclude: /node_modules/,
        use: [MiniCssExtractPlugin.loader,
            'css-loader',
        {
            loader: 'postcss-loader',
            options: {
                postcssOptions: {
                    plugins: [
                        postcssPresetEnv(),
                        cssnano({ preset: 'default', discardComments: { removeAll: true } })
                    ],
                },
            },
        }

        ],
    },
    {
        test: /\.eot(\?v=\d+.\d+.\d+)?$/,
        use: [
            {
                loader: 'url-loader',
                options: {
                    name: '[path][name].[ext]',
                },
            },
        ],
    },
    {
        test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
        use: [
            {
                loader: 'url-loader',
                options: {
                    limit: 10000,
                    mimetype: 'application/font-woff',
                    name: '[path][name].[ext]',
                },
            },
        ],
    },
    {
        test: /\.[ot]tf(\?v=\d+.\d+.\d+)?$/,
        use: [
            {
                loader: 'url-loader',
                options: {
                    limit: 10000,
                    mimetype: 'application/octet-stream',
                    name: '[path][name].[ext]',
                },
            },
        ],
    },
    {
        test: /\.svg(\?v=\d+\.\d+\.\d+)?$/,
        use: [
            {
                loader: 'url-loader',
                options: {
                    limit: 10000,
                    mimetype: 'image/svg+xml',
                    name: '[path][name].[ext]',
                },
            },
        ],
    },
    {
        test: /\.ttf$/,
        type: 'asset/resource',
        dependency: { not: ['url'] },
    },
    {
        test: /\.(jpe?g|png|gif|ico)$/i,
        use: [
            {
                loader: 'file-loader',
                options: {
                    name: '[path][name].[ext]',
                },
            },
        ],
    },
    {
        test: /\.(jpe?g|svg|png|gif|ico|eot|woff2?)(\?v=\d+\.\d+\.\d+)?$/i,
        type: 'asset/resource',
    },

]
const plugins = (argv) => [
    new CleanWebpackPlugin({
        cleanStaleWebpackAssets: ('production' === argv.mode),
    }),
    new webpack.ProvidePlugin({
        $: "jquery",
        jQuery: "jquery",
        "window.jQuery": "jquery"
    }),
    new MiniCssExtractPlugin({
        filename: 'css/[name].css'
    }),
]
module.exports = (env, argv) => ({
    entry: entry,
    output: output,
    devtool: 'source-map',
    module: {
        rules: rules,
    },
    plugins: plugins(argv),
    optimization: {
        minimizer: [
            new UglifyJsPlugin({
                cache: false,
                parallel: true,
                sourceMap: false,
                extractComments: true,
            }),
            new OptimizeCssAssetsPlugin()
        ]
    },
    stats: {
        errorDetails: true
    },
    resolve: {
        extensions: ['.ts', '.js'],
        modules: ['src/javascript', 'node_modules'],
    },
    externals: {
        jquery: 'jQuery'
    }
});