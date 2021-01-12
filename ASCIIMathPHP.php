<?php

namespace ASCIIMath2MathML;

class ASCIIMathPHP
{
    protected $_expr;
    protected $_curr_expr;
    protected $_prev_expr;
    protected $_symbol_arr;
    protected $_node_arr;
    protected $_node_cntr;

    public function __construct($symbol_arr = false, $expr = null) {
        if (!$symbol_arr) {
            $symbol_arr = array(

                // Greek symbols
                'alpha'      => array( 'input'=>'alpha',     'tag'=>'mi',     'output'=>'&#' . hexdec('03B1') . ';'),
                'beta'       => array( 'input'=>'beta',      'tag'=>'mi',     'output'=>'&#' . hexdec('03B2') . ';'),
                'chi'        => array( 'input'=>'chi',       'tag'=>'mi',     'output'=>'&#' . hexdec('03C7') . ';'),
                'delta'      => array( 'input'=>'delta',     'tag'=>'mi',     'output'=>'&#' . hexdec('03B4') . ';'),
                'Delta'      => array( 'input'=>'Delta',     'tag'=>'mo',     'output'=>'&#' . hexdec('0394') . ';'),
                'epsi'       => array( 'input'=>'epsi',      'tag'=>'mi',     'output'=>'&#' . hexdec('03B5') . ';'),
                'epsilon'       => array( 'input'=>'epsi',      'tag'=>'mi',     'output'=>'&#' . hexdec('03B5') . ';'),
                'varepsilon' => array( 'input'=>'varepsilon','tag'=>'mi',     'output'=>'&#' . hexdec('025B') . ';'),
                'eta'        => array( 'input'=>'eta',       'tag'=>'mi',     'output'=>'&#' . hexdec('03B7') . ';'),
                'gamma'      => array( 'input'=>'gamma',     'tag'=>'mi',     'output'=>'&#' . hexdec('03B3') . ';'),
                'Gamma'      => array( 'input'=>'Gamma',     'tag'=>'mi',     'output'=>'&#' . hexdec('0393') . ';'),
                'iota'       => array( 'input'=>'iota',      'tag'=>'mi',     'output'=>'&#' . hexdec('03B9') . ';'),
                'kappa'      => array( 'input'=>'kappa',     'tag'=>'mi',     'output'=>'&#' . hexdec('03BA') . ';'),
                'lambda'     => array( 'input'=>'lambda',    'tag'=>'mi',     'output'=>'&#' . hexdec('03BB') . ';'),
                'Lambda'     => array( 'input'=>'Lambda',    'tag'=>'mo',     'output'=>'&#' . hexdec('039B') . ';'),
                'mu'         => array( 'input'=>'mu',        'tag'=>'mi',     'output'=>'&#' . hexdec('03BC') . ';'),
                'nu'         => array( 'input'=>'nu',        'tag'=>'mi',     'output'=>'&#' . hexdec('03BD') . ';'),
                'omega'      => array( 'input'=>'omega',     'tag'=>'mi',     'output'=>'&#' . hexdec('03C9') . ';'),
                'Omega'      => array( 'input'=>'Omega',     'tag'=>'mo',     'output'=>'&#' . hexdec('03A9') . ';'),
                'phi'        => array( 'input'=>'phi',       'tag'=>'mi',     'output'=>'&#' . hexdec('03C6') . ';'),
                'varphi'     => array( 'input'=>'varphi',    'tag'=>'mi',     'output'=>'&#' . hexdec('03D5') . ';'),
                'Phi'        => array( 'input'=>'Phi',       'tag'=>'mo',     'output'=>'&#' . hexdec('03A6') . ';'),
                'pi'         => array( 'input'=>'pi',        'tag'=>'mi',     'output'=>'&#' . hexdec('03C0') . ';'),
                'Pi'         => array( 'input'=>'Pi',        'tag'=>'mo',     'output'=>'&#' . hexdec('03A0') . ';'),
                'psi'        => array( 'input'=>'psi',       'tag'=>'mi',     'output'=>'&#' . hexdec('03C8') . ';'),
                'rho'        => array( 'input'=>'rho',       'tag'=>'mi',     'output'=>'&#' . hexdec('03C1') . ';'),
                'sigma'      => array( 'input'=>'sigma',     'tag'=>'mi',     'output'=>'&#' . hexdec('03C3') . ';'),
                'Sigma'      => array( 'input'=>'Sigma',     'tag'=>'mo',     'output'=>'&#' . hexdec('03A3') . ';'),
                'tau'        => array( 'input'=>'tau',       'tag'=>'mi',     'output'=>'&#' . hexdec('03C4') . ';'),
                'theta'      => array( 'input'=>'theta',     'tag'=>'mi',     'output'=>'&#' . hexdec('03B8') . ';'),
                'vartheta'   => array( 'input'=>'vartheta',  'tag'=>'mi',     'output'=>'&#' . hexdec('03D1') . ';'),
                'Theta'      => array( 'input'=>'Theta',     'tag'=>'mo',     'output'=>'&#' . hexdec('0398') . ';'),
                'upsilon'    => array( 'input'=>'upsilon',   'tag'=>'mi',     'output'=>'&#' . hexdec('03C5') . ';'),
                'xi'         => array( 'input'=>'xi',        'tag'=>'mi',     'output'=>'&#' . hexdec('03BE') . ';'),
                'Xi'         => array( 'input'=>'alpha',     'tag'=>'mo',     'output'=>'&#' . hexdec('039E') . ';'),
                'zeta'       => array( 'input'=>'zeta',      'tag'=>'mi',     'output'=>'&#' . hexdec('03B6') . ';'),

                // Binary operation symbols
                '*'          => array( 'input'=>'*',         'tag'=>'mo',     'output'=>'&#' . hexdec('22C5') . ';'),
                '**'         => array( 'input'=>'**',        'tag'=>'mo',     'output'=>'&#' . hexdec('22C6') . ';'),
                '//'         => array( 'input'=>'//',        'tag'=>'mo',     'output'=>'/'),
                '\\\\'       => array( 'input'=>'\\\\',      'tag'=>'mo',     'output'=>'\\'),
                'xx'         => array( 'input'=>'xx',        'tag'=>'mo',     'output'=>'&#' . hexdec('00D7') . ';'),
                '-:'         => array( 'input'=>'-:',        'tag'=>'mo',     'output'=>'&#' . hexdec('00F7') . ';'),
                '@'          => array( 'input'=>'@',         'tag'=>'mo',     'output'=>'&#' . hexdec('2218') . ';'),
                'o+'         => array( 'input'=>'o+',        'tag'=>'mo',     'output'=>'&#' . hexdec('2295') . ';'),
                'ox'         => array( 'input'=>'ox',        'tag'=>'mo',     'output'=>'&#' . hexdec('2297') . ';'),
                'sum'        => array( 'input'=>'sum',       'tag'=>'mo',     'output'=>'&#' . hexdec('2211') . ';', 'underover'=>TRUE),
                'prod'       => array( 'input'=>'prod',      'tag'=>'mo',     'output'=>'&#' . hexdec('220F') . ';', 'underover'=>TRUE),
                '^^'         => array( 'input'=>'^^',        'tag'=>'mo',     'output'=>'&#' . hexdec('2227') . ';'),
                '^^^'        => array( 'input'=>'^^^',       'tag'=>'mo',     'output'=>'&#' . hexdec('22C0') . ';', 'underover'=>TRUE),
                'vv'         => array( 'input'=>'vv',        'tag'=>'mo',     'output'=>'&#' . hexdec('2228') . ';'),
                'vvv'        => array( 'input'=>'vvv',       'tag'=>'mo',     'output'=>'&#' . hexdec('22C1') . ';', 'underover'=>TRUE),
                'nn'         => array( 'input'=>'nn',        'tag'=>'mo',     'output'=>'&#' . hexdec('2229') . ';'),
                'nnn'        => array( 'input'=>'nnn',       'tag'=>'mo',     'output'=>'&#' . hexdec('22C5') . ';', 'underover'=>TRUE),
                'uu'         => array( 'input'=>'uu',        'tag'=>'mo',     'output'=>'&#' . hexdec('222A') . ';'),
                'uuu'        => array( 'input'=>'uuu',       'tag'=>'mo',     'output'=>'&#' . hexdec('22C3') . ';', 'underover'=>TRUE),

                // Binary relation symbols
                '!='         => array( 'input'=>'!=',        'tag'=>'mo',     'output'=>'&#' . hexdec('2260') . ';'),
                ':='         => array( 'input'=>':=',        'tag'=>'mo',     'output'=>':=' ),                          // 2005-06-05 wes
                '<'          => array( 'input'=>'<',         'tag'=>'mo',     'output'=>'&lt;'),
                'lt'         => array( 'input'=>'lt',        'tag'=>'mo',     'output'=>'&lt;'),                         // 2005-06-05 wes
                '<='         => array( 'input'=>'<=',        'tag'=>'mo',     'output'=>'&#' . hexdec('2264') . ';'),
                'lt='        => array( 'input'=>'lt=',       'tag'=>'mo',     'output'=>'&#' . hexdec('2264') . ';'),
                'le'         => array( 'input'=>'le',        'tag'=>'mo',     'output'=>'&#' . hexdec('2264') . ';'),    // 2005-06-05 wes
                '>'          => array( 'input'=>'>',         'tag'=>'mo',     'output'=>'&gt;'),
                '>='         => array( 'input'=>'>=',        'tag'=>'mo',     'output'=>'&#' . hexdec('2265') . ';'),
                'qeq'        => array( 'input'=>'geq',       'tag'=>'mo',     'output'=>'&#' . hexdec('2265') . ';'),
                '-<'         => array( 'input'=>'-<',        'tag'=>'mo',     'output'=>'&#' . hexdec('227A') . ';'),
                '-lt'        => array( 'input'=>'-lt',       'tag'=>'mo',     'output'=>'&#' . hexdec('227A') . ';'),
                '>-'         => array( 'input'=>'>-',        'tag'=>'mo',     'output'=>'&#' . hexdec('227B') . ';'),
                'in'         => array( 'input'=>'in',        'tag'=>'mo',     'output'=>'&#' . hexdec('2208') . ';'),
                '!in'        => array( 'input'=>'!in',       'tag'=>'mo',     'output'=>'&#' . hexdec('2209') . ';'),
                'sub'        => array( 'input'=>'sub',       'tag'=>'mo',     'output'=>'&#' . hexdec('2282') . ';'),
                'sup'        => array( 'input'=>'sup',       'tag'=>'mo',     'output'=>'&#' . hexdec('2283') . ';'),
                'sube'       => array( 'input'=>'sube',      'tag'=>'mo',     'output'=>'&#' . hexdec('2286') . ';'),
                'supe'       => array( 'input'=>'supe',      'tag'=>'mo',     'output'=>'&#' . hexdec('2287') . ';'),
                '-='         => array( 'input'=>'-=',        'tag'=>'mo',     'output'=>'&#' . hexdec('2261') . ';'),
                '~='         => array( 'input'=>'~=',        'tag'=>'mo',     'output'=>'&#' . hexdec('2245') . ';'),
                '~~'         => array( 'input'=>'~~',        'tag'=>'mo',     'output'=>'&#' . hexdec('2248') . ';'),
                'prop'       => array( 'input'=>'prop',      'tag'=>'mo',     'output'=>'&#' . hexdec('221D') . ';'),

                // Logical symbols
                'and'        => array( 'input'=>'and',       'tag'=>'mtext',  'output'=>'and', 'space'=>'1ex'),
                'or'         => array( 'input'=>'or',        'tag'=>'mtext',  'output'=>'or', 'space'=>'1ex'),
                'not'        => array( 'input'=>'not',       'tag'=>'mo',     'output'=>'&#' . hexdec('00AC') . ';'),
                '=>'         => array( 'input'=>'=>',        'tag'=>'mo',     'output'=>'&#' . hexdec('21D2') . ';'),
                'if'         => array( 'input'=>'if',        'tag'=>'mo',     'output'=>'if', 'space'=>'1ex'),
                'iff'        => array( 'input'=>'iff',       'tag'=>'mo',     'output'=>'&#' . hexdec('21D4') . ';'),
                '<=>'        => array( 'input'=>'iff',       'tag'=>'mo',     'output'=>'&#' . hexdec('21D4') . ';'),   // 2005-06-07 wes
                'AA'         => array( 'input'=>'AA',        'tag'=>'mo',     'output'=>'&#' . hexdec('2200') . ';'),
                'EE'         => array( 'input'=>'EE',        'tag'=>'mo',     'output'=>'&#' . hexdec('2203') . ';'),
                '_|_'        => array( 'input'=>'_|_',       'tag'=>'mo',     'output'=>'&#' . hexdec('22A5') . ';'),
                'TT'         => array( 'input'=>'TT',        'tag'=>'mo',     'output'=>'&#' . hexdec('22A4') . ';'),
                '|-'         => array( 'input'=>'|-',        'tag'=>'mo',     'output'=>'&#' . hexdec('22A2') . ';'),
                '|='         => array( 'input'=>'|=',        'tag'=>'mo',     'output'=>'&#' . hexdec('22A8') . ';'),

                // Miscellaneous symbols
                'ang'        => array( 'input'=>'ang',       'tag'=>'mo',     'output'=>'&#' . hexdec('2220') . ';'),
                'deg'        => array( 'input'=>'deg',       'tag'=>'mo',     'output'=>'&#' . hexdec('00B0') . ';'),
                'int'        => array( 'input'=>'int',       'tag'=>'mo',     'output'=>'&#' . hexdec('222B') . ';'),
                'dx'         => array( 'input'=>'dx',        'tag'=>'mi',     'output'=>'{:d x:}', 'definition'=>TRUE), // 2005-06-11 wes
                'dy'         => array( 'input'=>'dy',        'tag'=>'mi',     'output'=>'{:d y:}', 'definition'=>TRUE), // 2005-06-11 wes
                'dz'         => array( 'input'=>'dz',        'tag'=>'mi',     'output'=>'{:d z:}', 'definition'=>TRUE), // 2005-06-11 wes
                'dt'         => array( 'input'=>'dt',        'tag'=>'mi',     'output'=>'{:d t:}', 'definition'=>TRUE), // 2005-06-11 wes
                'oint'       => array( 'input'=>'oint',      'tag'=>'mo',     'output'=>'&#' . hexdec('222E') . ';'),
                'del'        => array( 'input'=>'del',       'tag'=>'mo',     'output'=>'&#' . hexdec('2202') . ';'),
                'grad'       => array( 'input'=>'grad',      'tag'=>'mo',     'output'=>'&#' . hexdec('2207') . ';'),
                '+-'         => array( 'input'=>'+-',        'tag'=>'mo',     'output'=>'&#' . hexdec('00B1') . ';'),
                'O/'         => array( 'input'=>'0/',        'tag'=>'mo',     'output'=>'&#' . hexdec('2205') . ';'),
                'oo'         => array( 'input'=>'oo',        'tag'=>'mo',     'output'=>'&#' . hexdec('221E') . ';'),
                'aleph'      => array( 'input'=>'aleph',     'tag'=>'mo',     'output'=>'&#' . hexdec('2135') . ';'),
                '...'        => array( 'input'=>'int',       'tag'=>'mo',     'output'=>'...'),
                '~'          => array( 'input'=>'!~',        'tag'=>'mo',     'output'=>'&#' . hexdec('0020') . ';'),
                '\\ '        => array( 'input'=>'~',         'tag'=>'mo',     'output'=>'&#' . hexdec('00A0') . ';'),
                'quad'       => array( 'input'=>'quad',      'tag'=>'mo',     'output'=>'&#' . hexdec('00A0') . ';&#' . hexdec('00A0') . ';'),
                'qquad'      => array( 'input'=>'qquad',     'tag'=>'mo',     'output'=>'&#' . hexdec('00A0') . ';&#' . hexdec('00A0') . ';&#' . hexdec('00A0') . ';'),
                'cdots'      => array( 'input'=>'cdots',     'tag'=>'mo',     'output'=>'&#' . hexdec('22EF') . ';'),
                'vdots'      => array( 'input'=>'vdots',     'tag'=>'mo',     'output'=>'&#' . hexdec('22EE') . ';'), // 2005-06-11 wes
                'ddots'      => array( 'input'=>'ddots',     'tag'=>'mo',     'output'=>'&#' . hexdec('22F1') . ';'), // 2005-06-11 wes
                'diamond'    => array( 'input'=>'diamond',   'tag'=>'mo',     'output'=>'&#' . hexdec('22C4') . ';'),
                'square'     => array( 'input'=>'square',    'tag'=>'mo',     'output'=>'&#' . hexdec('25A1') . ';'),
                '|_'         => array( 'input'=>'|_',        'tag'=>'mo',     'output'=>'&#' . hexdec('230A') . ';'),
                '_|'         => array( 'input'=>'_|',        'tag'=>'mo',     'output'=>'&#' . hexdec('230B') . ';'),
                '|~'         => array( 'input'=>'|~',        'tag'=>'mo',     'output'=>'&#' . hexdec('2308') . ';'),
                '~|'         => array( 'input'=>'~|',        'tag'=>'mo',     'output'=>'&#' . hexdec('2309') . ';'),
                'CC'         => array( 'input'=>'CC',        'tag'=>'mo',     'output'=>'&#' . hexdec('2102') . ';'),
                'NN'         => array( 'input'=>'NN',        'tag'=>'mo',     'output'=>'&#' . hexdec('2115') . ';'),
                'QQ'         => array( 'input'=>'QQ',        'tag'=>'mo',     'output'=>'&#' . hexdec('211A') . ';'),
                'RR'         => array( 'input'=>'RR',        'tag'=>'mo',     'output'=>'&#' . hexdec('211D') . ';'),
                'ZZ'         => array( 'input'=>'ZZ',        'tag'=>'mo',     'output'=>'&#' . hexdec('2124') . ';'),
                'infty'         => array( 'input'=>'infty',  'tag'=>'mo',     'output'=>'&#' . hexdec('221E') . ';'),

                // Standard functions
                'lim'        => array( 'input'=>'lim',       'tag'=>'mo',     'output'=>'lim',    'underover'=>TRUE),
                'Lim'        => array( 'input'=>'Lim',       'tag'=>'mo',     'output'=>'Lim',    'underover'=>TRUE),           // 2005-06-11 wes
                'sin'        => array( 'input'=>'sin',       'tag'=>'mo',     'output'=>'sin',    'unary'=>TRUE, 'func'=>TRUE),
                'cos'        => array( 'input'=>'cos',       'tag'=>'mo',     'output'=>'cos',    'unary'=>TRUE, 'func'=>TRUE),
                'tan'        => array( 'input'=>'tan',       'tag'=>'mo',     'output'=>'tan',    'unary'=>TRUE, 'func'=>TRUE),
                'arcsin'     => array( 'input'=>'arcsin',    'tag'=>'mo',     'output'=>'arcsin', 'unary'=>TRUE, 'func'=>TRUE), // 2006-09-07 DL
                'arccos'     => array( 'input'=>'arccos',    'tag'=>'mo',     'output'=>'arccos', 'unary'=>TRUE, 'func'=>TRUE), // 2006-09-07 DL
                'arctan'     => array( 'input'=>'arctan',    'tag'=>'mo',     'output'=>'arctan', 'unary'=>TRUE, 'func'=>TRUE), // 2006-09-07 DL
                'sinh'       => array( 'input'=>'sinh',      'tag'=>'mo',     'output'=>'sinh',   'unary'=>TRUE, 'func'=>TRUE),
                'cosh'       => array( 'input'=>'cosh',      'tag'=>'mo',     'output'=>'cosh',   'unary'=>TRUE, 'func'=>TRUE),
                'tanh'       => array( 'input'=>'tanh',      'tag'=>'mo',     'output'=>'tanh',   'unary'=>TRUE, 'func'=>TRUE),
                'cot'        => array( 'input'=>'cot',       'tag'=>'mo',     'output'=>'cot',    'unary'=>TRUE, 'func'=>TRUE),
                'sec'        => array( 'input'=>'sec',       'tag'=>'mo',     'output'=>'sec',    'unary'=>TRUE, 'func'=>TRUE),
                'csc'        => array( 'input'=>'csc',       'tag'=>'mo',     'output'=>'csc',    'unary'=>TRUE, 'func'=>TRUE),
                'coth'       => array( 'input'=>'coth',      'tag'=>'mo',     'output'=>'coth',   'unary'=>TRUE, 'func'=>TRUE),
                'sech'       => array( 'input'=>'sech',      'tag'=>'mo',     'output'=>'sech',   'unary'=>TRUE, 'func'=>TRUE),
                'csch'       => array( 'input'=>'csch',      'tag'=>'mo',     'output'=>'csch',   'unary'=>TRUE, 'func'=>TRUE),
                'log'        => array( 'input'=>'log',       'tag'=>'mo',     'output'=>'log',    'unary'=>TRUE, 'func'=>TRUE),
                'ln'         => array( 'input'=>'ln',        'tag'=>'mo',     'output'=>'ln',     'unary'=>TRUE, 'func'=>TRUE),
                'det'        => array( 'input'=>'det',       'tag'=>'mo',     'output'=>'det',    'unary'=>TRUE, 'func'=>TRUE),
                'dim'        => array( 'input'=>'dim',       'tag'=>'mo',     'output'=>'dim'),
                'mod'        => array( 'input'=>'mod',       'tag'=>'mo',     'output'=>'mod'),
                'gcd'        => array( 'input'=>'gcd',       'tag'=>'mo',     'output'=>'gcd',    'unary'=>TRUE, 'func'=>TRUE),
                'lcm'        => array( 'input'=>'lcm',       'tag'=>'mo',     'output'=>'lcm',    'unary'=>TRUE, 'func'=>TRUE),
                'lub'        => array( 'input'=>'lub',       'tag'=>'mo',     'output'=>'lub'),                                 // 2005-06-11 wes
                'glb'        => array( 'input'=>'glb',       'tag'=>'mo',     'output'=>'glb'),                                 // 2005-06-11 wes
                'min'        => array( 'input'=>'min',       'tag'=>'mo',     'output'=>'min',    'underover'=>TRUE),           // 2005-06-11 wes
                'max'        => array( 'input'=>'max',       'tag'=>'mo',     'output'=>'max',    'underover'=>TRUE),           // 2005-06-11 wes
                'f'          => array( 'input'=>'f',         'tag'=>'mi',     'output'=>'f',      'unary'=>TRUE, 'func'=>TRUE), // 2006-09-07 DL
                'g'          => array( 'input'=>'g',         'tag'=>'mi',     'output'=>'g',      'unary'=>TRUE, 'func'=>TRUE), // 2006-09-07 DL

                // Arrows
                'uarr'       => array( 'input'=>'uarr',      'tag'=>'mo',     'output'=>'&#' . hexdec('2191') . ';'),
                'darr'       => array( 'input'=>'darr',      'tag'=>'mo',     'output'=>'&#' . hexdec('2193') . ';'),
                'rarr'       => array( 'input'=>'rarr',      'tag'=>'mo',     'output'=>'&#' . hexdec('2192') . ';'),
                '->'         => array( 'input'=>'->',        'tag'=>'mo',     'output'=>'&#' . hexdec('2192') . ';'),
                '|->'        => array( 'input'=>'|->',       'tag'=>'mo',     'output'=>'&#' . hexdec('21A6') . ';'), // 2005-06-11 wes
                'larr'       => array( 'input'=>'larr',      'tag'=>'mo',     'output'=>'&#' . hexdec('2190') . ';'),
                'harr'       => array( 'input'=>'harr',      'tag'=>'mo',     'output'=>'&#' . hexdec('2194') . ';'),
                'rArr'       => array( 'input'=>'rArr',      'tag'=>'mo',     'output'=>'&#' . hexdec('21D2') . ';'),
                'lArr'       => array( 'input'=>'lArr',      'tag'=>'mo',     'output'=>'&#' . hexdec('21D0') . ';'),
                'hArr'       => array( 'input'=>'hArr',      'tag'=>'mo',     'output'=>'&#' . hexdec('21D4') . ';'),

                // Commands with argument
                'sqrt'       => array( 'input'=>'sqrt',      'tag'=>'msqrt',  'output'=>'sqrt',                      'unary'=>TRUE),
                'root'       => array( 'input'=>'root',      'tag'=>'mroot',  'output'=>'root',                      'binary'=>TRUE),
                'frac'       => array( 'input'=>'frac',      'tag'=>'mfrac',  'output'=>'/',                         'binary'=>TRUE),
                'stackrel'   => array( 'input'=>'stackrel',  'tag'=>'mover',  'output'=>'stackrel',                  'binary'=>TRUE), // 2005-06-05 wes
                '/'          => array( 'input'=>'/',         'tag'=>'mfrac',  'output'=>'/',                         'infix'=>TRUE),
                '_'          => array( 'input'=>'_',         'tag'=>'msub',   'output'=>'_',                         'infix'=>TRUE),
                '^'          => array( 'input'=>'^',         'tag'=>'msup',   'output'=>'^',                         'infix'=>TRUE),
                'hat'        => array( 'input'=>'hat',       'tag'=>'mover',  'output'=>'&#' . hexdec('005E') . ';', 'unary'=>TRUE, 'acc'=>TRUE),
                'bar'        => array( 'input'=>'bar',       'tag'=>'mover',  'output'=>'&#' . hexdec('00AF') . ';', 'unary'=>TRUE, 'acc'=>TRUE),
                'vec'        => array( 'input'=>'vec',       'tag'=>'mover',  'output'=>'&#' . hexdec('2192') . ';', 'unary'=>TRUE, 'acc'=>TRUE),
                'dot'        => array( 'input'=>'dot',       'tag'=>'mover',  'output'=>'.',                         'unary'=>TRUE, 'acc'=>TRUE),
                'ddot'       => array( 'input'=>'ddot',      'tag'=>'mover',  'output'=>'..',                        'unary'=>TRUE, 'acc'=>TRUE),
                'ul'         => array( 'input'=>'ul',        'tag'=>'munder', 'output'=>'&#' . hexdec('0332') . ';', 'unary'=>TRUE, 'acc'=>TRUE),
                'avec'       => array( 'input'=>'avec',      'tag'=>'munder', 'output'=>'~',                         'unary'=>TRUE, 'acc'=>TRUE),
                'text'       => array( 'input'=>'text',      'tag'=>'mtext',  'output'=>'text',                      'unary'=>TRUE),
                'mbox'       => array( 'input'=>'mbox',      'tag'=>'mtext',  'output'=>'mbox',                      'unary'=>TRUE),
                '"'          => array( 'input'=>'"',         'tag'=>'mtext',  'output'=>'mbox',                      'unary'=>TRUE),

                // Grouping brackets
                '('          => array( 'input'=>'(',         'tag'=>'mo',     'output'=>'(',                         'left_bracket'=>TRUE),
                ')'          => array( 'input'=>')',         'tag'=>'mo',     'output'=>')',                         'right_bracket'=>TRUE),
                '['          => array( 'input'=>'[',         'tag'=>'mo',     'output'=>'[',                         'left_bracket'=>TRUE),
                ']'          => array( 'input'=>']',         'tag'=>'mo',     'output'=>']',                         'right_bracket'=>TRUE),
                '{'          => array( 'input'=>'{',         'tag'=>'mo',     'output'=>'{',                         'left_bracket'=>TRUE),
                '}'          => array( 'input'=>'}',         'tag'=>'mo',     'output'=>'}',                         'right_bracket'=>TRUE),
                '(:'         => array( 'input'=>'(:',        'tag'=>'mo',     'output'=>'&#' . hexdec('2329') . ';', 'left_bracket'=>TRUE),
                ':)'         => array( 'input'=>':)',        'tag'=>'mo',     'output'=>'&#' . hexdec('232A') . ';', 'right_bracket'=>TRUE),
                '{:'         => array( 'input'=>'{:',        'tag'=>'mo',     'output'=>'{:',                        'left_bracket'=>TRUE,  'invisible'=>TRUE),
                ':}'         => array( 'input'=>':}',        'tag'=>'mo',     'output'=>':}',                        'right_bracket'=>TRUE ,'invisible'=>TRUE),
                '<<'         => array( 'input'=>'<<',        'tag'=>'mo',     'output'=>'&#' . hexdec('2329') . ';', 'left_bracket'=>TRUE), // 2005-06-07 wes
                '>>'         => array( 'input'=>'>>',        'tag'=>'mo',     'output'=>'&#' . hexdec('232A') . ';', 'right_bracket'=>TRUE) // 2005-06-07 wes
            );
        }
        $this->_symbol_arr = $symbol_arr;
        if (isset($expr)) {
            $this->setExpr($expr);
        }
    }

    /**
     * Returns an empty node (containing a non-breaking space) 26-Apr-2006
     *
     * Used when an expression is incomplete
     *
     * @return object
     *
     * @access private
     */
    public function emptyNode()
    {
        $tmp_node = $this->createNode();
        $tmp_node->setName('mn');
        $tmp_node->setContent('&#' . hexdec('200B') . ';');
        return $tmp_node;
    }

    public function pushExpr($prefix) // 2005-06-11 wes
    {
        $this->_curr_expr = $prefix . $this->_curr_expr;
    }

    public function setExpr($expr)
    {
        $this->_expr = $expr;
        $this->_curr_expr = $expr;
        $this->_prev_expr = $expr;

        $this->_node_arr = array();
        $this->_node_cntr = 0;
    }

    public function genMathML($attr_arr = null)
    {
        // <math> node
        $node_0 = $this->createNode();
        $node_0->setName('math');
        $node_0->setNamepace('http://www.w3.org/1998/Math/MathML');

        // <mstyle> node
        if (isset($attr_arr)) {
            $node_1 = $this->createNode();
            $node_1->setName('mstyle');
            $node_1->setAttrArr($attr_arr);

            $node_arr = $this->parseExpr();

            $node_1->addChildArr($node_arr);
            $node_0->addChild($node_1);
        } else {
            $node_arr = $this->parseExpr();
            $node_0->addChildArr($node_arr);
        }

        return true;
    }

    /*
    public function  mergeNodeArr(&$node_arr_0,&$node_arr_1)
    {
        $key_arr_0 = array_keys($node_arr_0);
        $key_arr_1 = array_keys($node_arr_1);

        $num_key_0 = count($key_arr_0);
        $num_key_1 = count($key_arr_1);

        $merge_arr = array();

        for ($i = 0;$i < $num_key_0;$i++) {
            $merge_arr[$key_arr_0[$i]] = $node_arr_0[$key_arr_0[$i]];
        }

        for ($j = 0;$j < $num_key_1;$i++) {
            $merge_arr[$key_arr_1[$i]] = $node_arr_1[$key_arr_1[$i]];
        }

        return($merge_arr);
    }
    */

    //Broken out of parseExpr Sept 7, 2006 David Lippman for
    //ASCIIMathML 1.4.7 compatibility
    public function parseIntExpr()
    {
        $sym_0 = $this->getSymbol();
        $node_0 = $this->parseSmplExpr();
        $sym = $this->getSymbol();

        if (isset($sym['infix']) && $sym['input'] != '/') {
            $this->chopExpr($sym['symlen']);
            $node_1 = $this->parseSmplExpr();

            if ($node_1 === false) { //show box in place of missing argument
                $node_1 = $this->emptyNode();//??
            } else {
                $node_1->removeBrackets();
            }

            // If 'sub' -- subscript
            if ($sym['input'] == '_') {

                $sym_1 = $this->getSymbol();

                // If 'sup' -- superscript
                if ($sym_1['input'] == '^') {
                    $this->chopExpr($sym_1['symlen']);
                    $node_2 = $this->parseSmplExpr();
                    $node_2->removeBrackets();

                    $node_3 = $this->createNode();
                    $node_3->setName(isset($sym_0['underover']) ? 'munderover' : 'msubsup');
                    $node_3->addChild($node_0);
                    $node_3->addChild($node_1);
                    $node_3->addChild($node_2);

                    $node_4 = $this->createNode();
                    $node_4->setName('mrow');
                    $node_4->addChild($node_3);

                    return $node_4;
                } else {
                    $node_2 = $this->createNode();
                    $node_2->setName(isset($sym_0['underover']) ? 'munder' : 'msub');
                    $node_2->addChild($node_0);
                    $node_2->addChild($node_1);

                    return $node_2;
                }
            } else {
                $node_2 = $this->createNode();
                $node_2->setName($sym['tag']);
                $node_2->addChild($node_0);
                $node_2->addChild($node_1);

                return($node_2);
            }
        } elseif ($node_0 !== false) {
            return($node_0);
        } else {
            return $this->emptyNode();
        }

    }

    public function parseExpr()
    {
        // Child/Fragment array
        $node_arr = array();

        // Deal whole expressions like 'ax + by + c = 0' etc.
        do {
            $sym_0 = $this->getSymbol();
            $node_0 = $this->parseIntExpr();
            $sym = $this->getSymbol();
            // var_dump($sym);

            if (isset($sym['infix']) && $sym['input'] == '/') {
                $this->chopExpr($sym['symlen']);
                $node_1 = $this->parseIntExpr();

                if ($node_1 === false) { //should show box in place of missing argument
                    $node_1 = $this->emptyNode();
                    continue;
                }

                $node_1->removeBrackets();

                // If 'div' -- divide
                $node_0->removeBrackets();
                $node_2 = $this->createNode();
                $node_2->setName($sym['tag']);
                $node_2->addChild($node_0);
                $node_2->addChild($node_1);
                $node_arr[$node_2->getId()] = $node_2;

            } elseif ($node_0 !== false) {
                $node_arr[$node_0->getId()] = $node_0;
            }
        } while (!isset($sym['right_bracket']) && $sym !== false && $sym['output'] != '');

        //var_dump($sym);
        // Possibly to deal with matrices
        if (isset($sym['right_bracket'])) {
            $node_cnt = count($node_arr);
            $key_node_arr = array_keys($node_arr);

            if ($node_cnt > 1) {
                $node_5 = $node_arr[$key_node_arr[$node_cnt-1]];
                $node_6 = $node_arr[$key_node_arr[$node_cnt-2]];
            } else {
                $node_5 = false;
                $node_6 = false;
            }

            // Dealing with matrices
            if ($node_5 !== false && $node_6 !== false &&
                $node_cnt > 1 &&
                $node_5->getName() == 'mrow' &&
                $node_6->getName() == 'mo' &&
                $node_6->getContent() == ',') {

                // Checking if Node 5 has a LastChild
                if ($node_7 = $node_5->getLastChild()) {
                    $node_7_cntnt = $node_7->getContent();
                } else {
                    $node_7_cntnt = false;
                }

                // If there is a right bracket
                if ($node_7 !== false && ($node_7_cntnt == ']' || $node_7_cntnt == ')')) {

                    // Checking if Node 5 has a firstChild
                    if ($node_8 = $node_5->getFirstChild()) {
                        $node_8_cntnt = $node_8->getContent();
                    } else {
                        $node_8_cntnt = false;
                    }

                    // If there is a matching left bracket
                    if ($node_8 !== false &&
                        (($node_8_cntnt == '(' && $node_7_cntnt == ')' && $sym['output'] != '}') ||
                        ($node_8_cntnt == '[' && $node_7_cntnt == ']'))) {

                        $is_mtrx_flg = true;
                        $comma_pos_arr = array();

                        $i = 0;

                        while ($i < $node_cnt && $is_mtrx_flg) {
                            $tmp_node = $node_arr[$key_node_arr[$i]];

                            if($tmp_node_first = $tmp_node->getFirstChild()) {
                                $tnfc = $tmp_node_first->getContent();
                            } else {
                                $tnfc = false;
                            }

                            if($tmp_node_last = $tmp_node->getLastChild()) {
                                $tnlc = $tmp_node_last->getContent();
                            } else {
                                $tnlc = false;
                            }

                            if (isset($key_node_arr[$i+1])) {
                                $next_tmp_node = $node_arr[$key_node_arr[$i+1]];
                                $ntnn = $next_tmp_node->getName();
                                $ntnc = $next_tmp_node->getContent();
                            } else {
                                $ntnn = false;
                                $ntnc = false;
                            }

                            // Checking each node in node array for matrix criteria
                            if ($is_mtrx_flg) {
                                $is_mtrx_flg = $tmp_node->getName() == 'mrow' &&
                                    ($i == $node_cnt-1 || $ntnn == 'mo' && $ntnc == ',') &&
                                    $tnfc == $node_8_cntnt && $tnlc == $node_7_cntnt;
                            }

                            if ($is_mtrx_flg) {
                                for ($j = 0;$j < $tmp_node->getNumChild();$j++) {
                                    $tmp_c_node = $tmp_node->getChildByIdx($j);

                                    if ($tmp_c_node->getContent() == ',') {
                                        $comma_pos_arr[$i][] = $j;
                                    }
                                }
                            }

                            if ($is_mtrx_flg && $i > 1) {

                                $cnt_cpan = isset($comma_pos_arr[$i]) ? count($comma_pos_arr[$i]) : null;
                                $cnt_cpap = isset($comma_pos_arr[$i-2]) ? count($comma_pos_arr[$i-2]) : null;
                                $is_mtrx_flg = $cnt_cpan == $cnt_cpap;
                            }

                            $i += 2;
                        }

                        // If the node passes the matrix tests
                        if ($is_mtrx_flg) {
                            $tab_node_arr = array();

                            for ($i = 0;$i < $node_cnt;$i += 2) {
                                $tmp_key_node_arr = array_keys($node_arr);
                                if (!($tmp_node = $node_arr[$tmp_key_node_arr[0]])) {
                                    break;
                                }
                                $num_child = $tmp_node->getNumChild();
                                $k = 0;

                                $tmp_node->removeFirstChild();

                                $row_node_arr = array();
                                $row_frag_node_arr = array();

                                for ($j = 1;$j < ($num_child-1);$j++) {
                                    if (isset($comma_pos_arr[$i][$k]) &&
                                        $j == $comma_pos_arr[$i][$k]) {

                                        $tmp_node->removeFirstChild();

                                        $tmp_c_node = $this->createNode();
                                        $tmp_c_node->setName('mtd');
                                        $tmp_c_node->addChildArr($row_frag_node_arr);
                                        $row_frag_node_arr = array();

                                        $row_node_arr[$tmp_c_node->getId()] = $tmp_c_node;

                                        $k++;
                                    } else {

                                        if ($tmp_c_node = $tmp_node->getFirstChild()) {
                                            $row_frag_node_arr[$tmp_c_node->getId()] = $tmp_c_node;
                                            $tmp_node->removeFirstChild();
                                        }
                                    }
                                }

                                $tmp_c_node = $this->createNode();
                                $tmp_c_node->setName('mtd');
                                $tmp_c_node->addChildArr($row_frag_node_arr);

                                $row_node_arr[$tmp_c_node->getId()] = $tmp_c_node;

                                if (count($node_arr) > 2) {
                                    $tmp_key_node_arr = array_keys($node_arr);
                                    unset($node_arr[$tmp_key_node_arr[0]]);
                                    unset($node_arr[$tmp_key_node_arr[1]]);
                                }

                                $tmp_c_node = $this->createNode();
                                $tmp_c_node->setName('mtr');
                                $tmp_c_node->addChildArr($row_node_arr);

                                $tab_node_arr[$tmp_c_node->getId()] = $tmp_c_node;
                            }

                            $tmp_c_node = $this->createNode();
                            $tmp_c_node->setName('mtable');
                            $tmp_c_node->addChildArr($tab_node_arr);

                            if (isset($sym['invisible'])) {
                                $tmp_c_node->setAttr('columnalign','left');
                            }

                            $key_node_arr = array_keys($node_arr);
                            $tmp_c_node->setId($key_node_arr[0]);

                            $node_arr[$tmp_c_node->getId()] = $tmp_c_node;
                        }
                    }
                }
            }

            $this->chopExpr($sym['symlen']);
            if (!isset($sym['invisible'])) {
                $node_7 = $this->createNode();
                $node_7->setName('mo');
                $node_7->setContent($sym['output']);
                $node_arr[$node_7->getId()] = $node_7;
            }
        }

        return($node_arr);
    }

    public function parseSmplExpr()
    {
        $sym = $this->getSymbol();

        if (!$sym || isset($sym['right_bracket'])) //return false;
            return $this->emptyNode();

        $this->chopExpr($sym['symlen']);

        // 2005-06-11 wes: add definition type support
        if(isset($sym['definition'])) {
            $this->pushExpr($sym['output']);
            $sym = $this->getSymbol();
            $this->chopExpr($sym['symlen']);
        }

        if (isset($sym['left_bracket'])) {
            $node_arr = $this->parseExpr();

            if (isset($sym['invisible'])) {
                $node_0 = $this->createNode();
                $node_0->setName('mrow');
                $node_0->addChildArr($node_arr);

                return($node_0);
            } else {
                $node_0 = $this->createNode();
                $node_0->setName('mo');
                $node_0->setContent($sym['output']);

                $node_1 = $this->createNode();
                $node_1->setName('mrow');
                $node_1->addChild($node_0);
                $node_1->addChildArr($node_arr);

                return($node_1);
            }
        } elseif (isset($sym['unary'])) {

            if ($sym['input'] == 'sqrt') {
                $node_0 = $this->parseSmplExpr();
                $node_0->removeBrackets();

                $node_1 = $this->createNode();
                $node_1->setName($sym['tag']);
                $node_1->addChild($node_0);

                return($node_1);
            } elseif (isset($sym['func'])) { //added 2006-9-7 David Lippman
                $expr = ltrim($this->getCurrExpr());
                $st = $expr{0};
                $node_0 = $this->parseSmplExpr();
                //$node_0->removeBrackets();
                if ($st=='^' || $st == '_' || $st=='/' || $st=='|' || $st==',') {
                    $node_1 = $this->createNode();
                    $node_1->setName($sym['tag']);
                    $node_1->setContent($sym['output']);
                    $this->setCurrExpr($expr);
                    return($node_1);
                } else {
                    $node_1 = $this->createNode();
                    $node_1->setName('mrow');
                    $node_2 = $this->createNode();
                    $node_2->setName($sym['tag']);
                    $node_2->setContent($sym['output']);
                    $node_1->addChild($node_2);
                    $node_1->addChild($node_0);
                    return($node_1);
                }
            } elseif ($sym['input'] == 'text' || $sym['input'] == 'mbox' || $sym['input'] == '"') {
                $expr = ltrim($this->getCurrExpr());
                if ($sym['input']=='"') {
                    $end_brckt = '"';
                    $txt = substr($expr,0,strpos($expr,$end_brckt));
                } else {
                    switch($expr{0}) {
                        case '(':
                            $end_brckt = ')';
                            break;
                        case '[':
                            $end_brckt = ']';
                            break;
                        case '{':
                            $end_brckt = '}';
                            break;
                        default:
                            $end_brckt = chr(11); // A character that will never be matched.
                            break;
                    }
                    $txt = substr($expr,1,strpos($expr,$end_brckt)-1);
                }

                //$txt = substr($expr,1,strpos($expr,$end_brckt)-1);
                $len = strlen($txt);

                $node_0 = $this->createNode();
                $node_0->setName('mrow');

                if ($len > 0) {
                    if ($txt{0} == " ") {
                        $node_1 = $this->createNode();
                        $node_1->setName('mspace');
                        $node_1->setAttr('width','1ex');

                        $node_0->addChild($node_1);
                    }

                    $node_3 = $this->createNode();
                    $node_3->setName($sym['tag']);
                    $node_3->setContent(trim($txt));

                    $node_0->addChild($node_3);

                    if ($len > 1 && $txt{$len-1} == " ") {
                        $node_2 = $this->createNode();
                        $node_2->setName('mspace');
                        $node_2->setAttr('width','1ex');

                        $node_0->addChild($node_2);
                    }

                    $this->chopExpr($len+2);
                }
                return($node_0);

            } elseif (isset($sym['acc'])) {
                $node_0 = $this->parseSmplExpr();
                $node_0->removeBrackets();

                $node_1 = $this->createNode();
                $node_1->setName($sym['tag']);
                $node_1->addChild($node_0);

                $node_2 = $this->createNode();
                $node_2->setName('mo');
                $node_2->setContent($sym['output']);

                $node_1->addChild($node_2);
                return($node_1);
            } else {
                // Font change commands -- to complete
            }
        } elseif (isset($sym['binary'])) {
            $node_arr = array();

            $node_0 = $this->parseSmplExpr();
            $node_0->removeBrackets();

            $node_1 = $this->parseSmplExpr();
            $node_1->removeBrackets();

            /* 2005-06-05 wes: added stackrel */
            if ($sym['input'] == 'root' || $sym['input'] == 'stackrel') {
                $node_arr[$node_1->getId()] = $node_1;
                $node_arr[$node_0->getId()] = $node_0;
            } elseif ($sym['input'] == 'frac') {
                $node_arr[$node_0->getId()] = $node_0;
                $node_arr[$node_1->getId()] = $node_1;
            }

            $node_2 = $this->createNode();
            $node_2->setName($sym['tag']);
            $node_2->addChildArr($node_arr);

            return($node_2);
        } elseif (isset($sym['infix'])) {
            $node_0 = $this->createNode();
            $node_0->setName('mo');
            $node_0->setContent($sym['output']);

            return($node_0);
        } elseif (isset($sym['space'])) {
            $node_0 = $this->createNode();
            $node_0->setName('mrow');

            $node_1 = $this->createNode();
            $node_1->setName('mspace');
            $node_1->setAttr('width',$sym['space']);

            $node_2 = $this->createNode();
            $node_2->setName($sym['tag']);
            $node_2->setContent($sym['output']);

            $node_3 = $this->createNode();
            $node_3->setName('mspace');
            $node_3->setAttr('width',$sym['space']);

            $node_0->addChild($node_1);
            $node_0->addChild($node_2);
            $node_0->addChild($node_3);

            return($node_0);
        } else {

            // A constant
            $node_0 = $this->createNode();
            $node_0->setName($sym['tag']);
            $node_0->setContent($sym['output']);
            return($node_0);
        }

        // Return an empty node
        return $this->emptyNode();
    }

    public function getMathML()
    {
        $root = $this->_node_arr[0];
        return($root->dumpXML());
    }

    public function getCurrExpr()
    {
        return($this->_curr_expr);
    }

    public function setCurrExpr($str)
    {
        $this->_curr_expr = $str;
    }

    public function getExpr()
    {
        return($this->_expr);
    }

    public function getPrevExpr()
    {
        return($this->_prev_expr);
    }

    public function  createNode()
    {
        $node = new \ASCIIMath2MathML\MathMLNode($this->_node_cntr);
        // $node->setNamespaceAlias('m');
        $this->_node_arr[$this->_node_cntr] = $node;
        $this->_node_cntr++;
        return($node);
    }

    /**
     * Gets the largest symbol in the expression (greedy). Changed from non-greedy 26-Apr-2006
     *
     * @parameter boolean[optional] Chop original string?
     *
     * @return mixed
     *
     * @access private
     */
    public function getSymbol($chop_flg = false)
    {
        // Implemented a reverse symbol matcher.
        // Instead of going front to back, it goes back to front. Steven 26-Apr-2006
        $chr_cnt = strlen($this->_curr_expr);

        if ($chr_cnt == 0) return false;

        for ($i = $chr_cnt; $i > 0; $i--) {
            $sym_0 = substr($this->_curr_expr,0,$i);

            // Reading string for numeric values
            if (is_numeric($sym_0)) {

                if ($chop_flg) $this->chopExpr($i);
                return array('input'=>$sym_0, 'tag'=>'mn', 'output'=>$sym_0, 'symlen'=>$i);

            } elseif (isset($this->_symbol_arr[$sym_0])) {

                if ($chop_flg) $this->chopExpr($i);
                $sym_arr = $this->_symbol_arr[$sym_0];
                $sym_arr['symlen'] = $i;
                return $sym_arr;
            }
        }

        // Reading string for alphabetic constants and the minus sign
        $char = $this->_curr_expr{0};
        $len_left = $chop_flg ? $this->chopExpr(1) : strlen($this->_curr_expr)-1;

        // Deals with expressions of length 1
        if ($len_left == 0 && isset($this->_symbol_arr[$char])) {
            $sym_arr = $this->_symbol_arr[$char];
            $sym_arr['symlen'] = 1;
            return $sym_arr;
        } else {
            $tag = preg_match('/[a-z]/i',$char) ? 'mi' : 'mo';
            return array('input'=>$char, 'tag'=>$tag, 'output'=>$char, 'symlen'=>1);
        }
    }

    public function chopExpr($strlen)
    {
        $this->_prev_expr = $this->_curr_expr;

        if ($strlen == strlen($this->_curr_expr)) {
            $this->_curr_expr = '';
            return(0);
        } else {
            $this->_curr_expr = ltrim(substr($this->_curr_expr,$strlen));
            return(strlen($this->_curr_expr));
        }
    }
}