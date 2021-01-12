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
            $symbol_arr = [

                // Greek symbols
                'alpha'      => ['input'=>'alpha',     'tag'=>'mi',     'output'=>'&#' . hexdec('03B1') . ';'],
                'beta'       => ['input'=>'beta',      'tag'=>'mi',     'output'=>'&#' . hexdec('03B2') . ';'],
                'chi'        => ['input'=>'chi',       'tag'=>'mi',     'output'=>'&#' . hexdec('03C7') . ';'],
                'delta'      => ['input'=>'delta',     'tag'=>'mi',     'output'=>'&#' . hexdec('03B4') . ';'],
                'Delta'      => ['input'=>'Delta',     'tag'=>'mo',     'output'=>'&#' . hexdec('0394') . ';'],
                'epsi'       => ['input'=>'epsi',      'tag'=>'mi',     'output'=>'&#' . hexdec('03B5') . ';'],
                'epsilon'       => ['input'=>'epsi',      'tag'=>'mi',     'output'=>'&#' . hexdec('03B5') . ';'],
                'varepsilon' => ['input'=>'varepsilon','tag'=>'mi',     'output'=>'&#' . hexdec('025B') . ';'],
                'eta'        => ['input'=>'eta',       'tag'=>'mi',     'output'=>'&#' . hexdec('03B7') . ';'],
                'gamma'      => ['input'=>'gamma',     'tag'=>'mi',     'output'=>'&#' . hexdec('03B3') . ';'],
                'Gamma'      => ['input'=>'Gamma',     'tag'=>'mi',     'output'=>'&#' . hexdec('0393') . ';'],
                'iota'       => ['input'=>'iota',      'tag'=>'mi',     'output'=>'&#' . hexdec('03B9') . ';'],
                'kappa'      => ['input'=>'kappa',     'tag'=>'mi',     'output'=>'&#' . hexdec('03BA') . ';'],
                'lambda'     => ['input'=>'lambda',    'tag'=>'mi',     'output'=>'&#' . hexdec('03BB') . ';'],
                'Lambda'     => ['input'=>'Lambda',    'tag'=>'mo',     'output'=>'&#' . hexdec('039B') . ';'],
                'mu'         => ['input'=>'mu',        'tag'=>'mi',     'output'=>'&#' . hexdec('03BC') . ';'],
                'nu'         => ['input'=>'nu',        'tag'=>'mi',     'output'=>'&#' . hexdec('03BD') . ';'],
                'omega'      => ['input'=>'omega',     'tag'=>'mi',     'output'=>'&#' . hexdec('03C9') . ';'],
                'Omega'      => ['input'=>'Omega',     'tag'=>'mo',     'output'=>'&#' . hexdec('03A9') . ';'],
                'phi'        => ['input'=>'phi',       'tag'=>'mi',     'output'=>'&#' . hexdec('03C6') . ';'],
                'varphi'     => ['input'=>'varphi',    'tag'=>'mi',     'output'=>'&#' . hexdec('03D5') . ';'],
                'Phi'        => ['input'=>'Phi',       'tag'=>'mo',     'output'=>'&#' . hexdec('03A6') . ';'],
                'pi'         => ['input'=>'pi',        'tag'=>'mi',     'output'=>'&#' . hexdec('03C0') . ';'],
                'Pi'         => ['input'=>'Pi',        'tag'=>'mo',     'output'=>'&#' . hexdec('03A0') . ';'],
                'psi'        => ['input'=>'psi',       'tag'=>'mi',     'output'=>'&#' . hexdec('03C8') . ';'],
                'rho'        => ['input'=>'rho',       'tag'=>'mi',     'output'=>'&#' . hexdec('03C1') . ';'],
                'sigma'      => ['input'=>'sigma',     'tag'=>'mi',     'output'=>'&#' . hexdec('03C3') . ';'],
                'Sigma'      => ['input'=>'Sigma',     'tag'=>'mo',     'output'=>'&#' . hexdec('03A3') . ';'],
                'tau'        => ['input'=>'tau',       'tag'=>'mi',     'output'=>'&#' . hexdec('03C4') . ';'],
                'theta'      => ['input'=>'theta',     'tag'=>'mi',     'output'=>'&#' . hexdec('03B8') . ';'],
                'vartheta'   => ['input'=>'vartheta',  'tag'=>'mi',     'output'=>'&#' . hexdec('03D1') . ';'],
                'Theta'      => ['input'=>'Theta',     'tag'=>'mo',     'output'=>'&#' . hexdec('0398') . ';'],
                'upsilon'    => ['input'=>'upsilon',   'tag'=>'mi',     'output'=>'&#' . hexdec('03C5') . ';'],
                'xi'         => ['input'=>'xi',        'tag'=>'mi',     'output'=>'&#' . hexdec('03BE') . ';'],
                'Xi'         => ['input'=>'alpha',     'tag'=>'mo',     'output'=>'&#' . hexdec('039E') . ';'],
                'zeta'       => ['input'=>'zeta',      'tag'=>'mi',     'output'=>'&#' . hexdec('03B6') . ';'],

                // Binary operation symbols
                '*'          => ['input'=>'*',         'tag'=>'mo',     'output'=>'&#' . hexdec('22C5') . ';'],
                '**'         => ['input'=>'**',        'tag'=>'mo',     'output'=>'&#' . hexdec('22C6') . ';'],
                '//'         => ['input'=>'//',        'tag'=>'mo',     'output'=>'/'],
                '\\\\'       => ['input'=>'\\\\',      'tag'=>'mo',     'output'=>'\\'],
                'xx'         => ['input'=>'xx',        'tag'=>'mo',     'output'=>'&#' . hexdec('00D7') . ';'],
                '-:'         => ['input'=>'-:',        'tag'=>'mo',     'output'=>'&#' . hexdec('00F7') . ';'],
                '@'          => ['input'=>'@',         'tag'=>'mo',     'output'=>'&#' . hexdec('2218') . ';'],
                'o+'         => ['input'=>'o+',        'tag'=>'mo',     'output'=>'&#' . hexdec('2295') . ';'],
                'ox'         => ['input'=>'ox',        'tag'=>'mo',     'output'=>'&#' . hexdec('2297') . ';'],
                'sum'        => ['input'=>'sum',       'tag'=>'mo',     'output'=>'&#' . hexdec('2211') . ';', 'underover'=>TRUE],
                'prod'       => ['input'=>'prod',      'tag'=>'mo',     'output'=>'&#' . hexdec('220F') . ';', 'underover'=>TRUE],
                '^^'         => ['input'=>'^^',        'tag'=>'mo',     'output'=>'&#' . hexdec('2227') . ';'],
                '^^^'        => ['input'=>'^^^',       'tag'=>'mo',     'output'=>'&#' . hexdec('22C0') . ';', 'underover'=>TRUE],
                'vv'         => ['input'=>'vv',        'tag'=>'mo',     'output'=>'&#' . hexdec('2228') . ';'],
                'vvv'        => ['input'=>'vvv',       'tag'=>'mo',     'output'=>'&#' . hexdec('22C1') . ';', 'underover'=>TRUE],
                'nn'         => ['input'=>'nn',        'tag'=>'mo',     'output'=>'&#' . hexdec('2229') . ';'],
                'nnn'        => ['input'=>'nnn',       'tag'=>'mo',     'output'=>'&#' . hexdec('22C5') . ';', 'underover'=>TRUE],
                'uu'         => ['input'=>'uu',        'tag'=>'mo',     'output'=>'&#' . hexdec('222A') . ';'],
                'uuu'        => ['input'=>'uuu',       'tag'=>'mo',     'output'=>'&#' . hexdec('22C3') . ';', 'underover'=>TRUE],

                // Binary relation symbols
                '!='         => ['input'=>'!=',        'tag'=>'mo',     'output'=>'&#' . hexdec('2260') . ';'],
                ':='         => ['input'=>':=',        'tag'=>'mo',     'output'=>':='],                          // 2005-06-05 wes
                '<'          => ['input'=>'<',         'tag'=>'mo',     'output'=>'&lt;'],
                'lt'         => ['input'=>'lt',        'tag'=>'mo',     'output'=>'&lt;'],                         // 2005-06-05 wes
                '<='         => ['input'=>'<=',        'tag'=>'mo',     'output'=>'&#' . hexdec('2264') . ';'],
                'lt='        => ['input'=>'lt=',       'tag'=>'mo',     'output'=>'&#' . hexdec('2264') . ';'],
                'le'         => ['input'=>'le',        'tag'=>'mo',     'output'=>'&#' . hexdec('2264') . ';'],    // 2005-06-05 wes
                '>'          => ['input'=>'>',         'tag'=>'mo',     'output'=>'&gt;'],
                '>='         => ['input'=>'>=',        'tag'=>'mo',     'output'=>'&#' . hexdec('2265') . ';'],
                'qeq'        => ['input'=>'geq',       'tag'=>'mo',     'output'=>'&#' . hexdec('2265') . ';'],
                '-<'         => ['input'=>'-<',        'tag'=>'mo',     'output'=>'&#' . hexdec('227A') . ';'],
                '-lt'        => ['input'=>'-lt',       'tag'=>'mo',     'output'=>'&#' . hexdec('227A') . ';'],
                '>-'         => ['input'=>'>-',        'tag'=>'mo',     'output'=>'&#' . hexdec('227B') . ';'],
                'in'         => ['input'=>'in',        'tag'=>'mo',     'output'=>'&#' . hexdec('2208') . ';'],
                '!in'        => ['input'=>'!in',       'tag'=>'mo',     'output'=>'&#' . hexdec('2209') . ';'],
                'sub'        => ['input'=>'sub',       'tag'=>'mo',     'output'=>'&#' . hexdec('2282') . ';'],
                'sup'        => ['input'=>'sup',       'tag'=>'mo',     'output'=>'&#' . hexdec('2283') . ';'],
                'sube'       => ['input'=>'sube',      'tag'=>'mo',     'output'=>'&#' . hexdec('2286') . ';'],
                'supe'       => ['input'=>'supe',      'tag'=>'mo',     'output'=>'&#' . hexdec('2287') . ';'],
                '-='         => ['input'=>'-=',        'tag'=>'mo',     'output'=>'&#' . hexdec('2261') . ';'],
                '~='         => ['input'=>'~=',        'tag'=>'mo',     'output'=>'&#' . hexdec('2245') . ';'],
                '~~'         => ['input'=>'~~',        'tag'=>'mo',     'output'=>'&#' . hexdec('2248') . ';'],
                'prop'       => ['input'=>'prop',      'tag'=>'mo',     'output'=>'&#' . hexdec('221D') . ';'],

                // Logical symbols
                'and'        => ['input'=>'and',       'tag'=>'mtext',  'output'=>'and', 'space'=>'1ex'],
                'or'         => ['input'=>'or',        'tag'=>'mtext',  'output'=>'or', 'space'=>'1ex'],
                'not'        => ['input'=>'not',       'tag'=>'mo',     'output'=>'&#' . hexdec('00AC') . ';'],
                '=>'         => ['input'=>'=>',        'tag'=>'mo',     'output'=>'&#' . hexdec('21D2') . ';'],
                'if'         => ['input'=>'if',        'tag'=>'mo',     'output'=>'if', 'space'=>'1ex'],
                'iff'        => ['input'=>'iff',       'tag'=>'mo',     'output'=>'&#' . hexdec('21D4') . ';'],
                '<=>'        => ['input'=>'iff',       'tag'=>'mo',     'output'=>'&#' . hexdec('21D4') . ';'],   // 2005-06-07 wes
                'AA'         => ['input'=>'AA',        'tag'=>'mo',     'output'=>'&#' . hexdec('2200') . ';'],
                'EE'         => ['input'=>'EE',        'tag'=>'mo',     'output'=>'&#' . hexdec('2203') . ';'],
                '_|_'        => ['input'=>'_|_',       'tag'=>'mo',     'output'=>'&#' . hexdec('22A5') . ';'],
                'TT'         => ['input'=>'TT',        'tag'=>'mo',     'output'=>'&#' . hexdec('22A4') . ';'],
                '|-'         => ['input'=>'|-',        'tag'=>'mo',     'output'=>'&#' . hexdec('22A2') . ';'],
                '|='         => ['input'=>'|=',        'tag'=>'mo',     'output'=>'&#' . hexdec('22A8') . ';'],

                // Miscellaneous symbols
                'ang'        => ['input'=>'ang',       'tag'=>'mo',     'output'=>'&#' . hexdec('2220') . ';'],
                'deg'        => ['input'=>'deg',       'tag'=>'mo',     'output'=>'&#' . hexdec('00B0') . ';'],
                'int'        => ['input'=>'int',       'tag'=>'mo',     'output'=>'&#' . hexdec('222B') . ';'],
                'dx'         => ['input'=>'dx',        'tag'=>'mi',     'output'=>'{:d x:}', 'definition'=>TRUE], // 2005-06-11 wes
                'dy'         => ['input'=>'dy',        'tag'=>'mi',     'output'=>'{:d y:}', 'definition'=>TRUE], // 2005-06-11 wes
                'dz'         => ['input'=>'dz',        'tag'=>'mi',     'output'=>'{:d z:}', 'definition'=>TRUE], // 2005-06-11 wes
                'dt'         => ['input'=>'dt',        'tag'=>'mi',     'output'=>'{:d t:}', 'definition'=>TRUE], // 2005-06-11 wes
                'oint'       => ['input'=>'oint',      'tag'=>'mo',     'output'=>'&#' . hexdec('222E') . ';'],
                'del'        => ['input'=>'del',       'tag'=>'mo',     'output'=>'&#' . hexdec('2202') . ';'],
                'grad'       => ['input'=>'grad',      'tag'=>'mo',     'output'=>'&#' . hexdec('2207') . ';'],
                '+-'         => ['input'=>'+-',        'tag'=>'mo',     'output'=>'&#' . hexdec('00B1') . ';'],
                'O/'         => ['input'=>'0/',        'tag'=>'mo',     'output'=>'&#' . hexdec('2205') . ';'],
                'oo'         => ['input'=>'oo',        'tag'=>'mo',     'output'=>'&#' . hexdec('221E') . ';'],
                'aleph'      => ['input'=>'aleph',     'tag'=>'mo',     'output'=>'&#' . hexdec('2135') . ';'],
                '...'        => ['input'=>'int',       'tag'=>'mo',     'output'=>'...'],
                '~'          => ['input'=>'!~',        'tag'=>'mo',     'output'=>'&#' . hexdec('0020') . ';'],
                '\\ '        => ['input'=>'~',         'tag'=>'mo',     'output'=>'&#' . hexdec('00A0') . ';'],
                'quad'       => ['input'=>'quad',      'tag'=>'mo',     'output'=>'&#' . hexdec('00A0') . ';&#' . hexdec('00A0') . ';'],
                'qquad'      => ['input'=>'qquad',     'tag'=>'mo',     'output'=>'&#' . hexdec('00A0') . ';&#' . hexdec('00A0') . ';&#' . hexdec('00A0') . ';'],
                'cdots'      => ['input'=>'cdots',     'tag'=>'mo',     'output'=>'&#' . hexdec('22EF') . ';'],
                'vdots'      => ['input'=>'vdots',     'tag'=>'mo',     'output'=>'&#' . hexdec('22EE') . ';'], // 2005-06-11 wes
                'ddots'      => ['input'=>'ddots',     'tag'=>'mo',     'output'=>'&#' . hexdec('22F1') . ';'], // 2005-06-11 wes
                'diamond'    => ['input'=>'diamond',   'tag'=>'mo',     'output'=>'&#' . hexdec('22C4') . ';'],
                'square'     => ['input'=>'square',    'tag'=>'mo',     'output'=>'&#' . hexdec('25A1') . ';'],
                '|_'         => ['input'=>'|_',        'tag'=>'mo',     'output'=>'&#' . hexdec('230A') . ';'],
                '_|'         => ['input'=>'_|',        'tag'=>'mo',     'output'=>'&#' . hexdec('230B') . ';'],
                '|~'         => ['input'=>'|~',        'tag'=>'mo',     'output'=>'&#' . hexdec('2308') . ';'],
                '~|'         => ['input'=>'~|',        'tag'=>'mo',     'output'=>'&#' . hexdec('2309') . ';'],
                'CC'         => ['input'=>'CC',        'tag'=>'mo',     'output'=>'&#' . hexdec('2102') . ';'],
                'NN'         => ['input'=>'NN',        'tag'=>'mo',     'output'=>'&#' . hexdec('2115') . ';'],
                'QQ'         => ['input'=>'QQ',        'tag'=>'mo',     'output'=>'&#' . hexdec('211A') . ';'],
                'RR'         => ['input'=>'RR',        'tag'=>'mo',     'output'=>'&#' . hexdec('211D') . ';'],
                'ZZ'         => ['input'=>'ZZ',        'tag'=>'mo',     'output'=>'&#' . hexdec('2124') . ';'],
                'infty'         => ['input'=>'infty',  'tag'=>'mo',     'output'=>'&#' . hexdec('221E') . ';'],

                // Standard functions
                'lim'        => ['input'=>'lim',       'tag'=>'mo',     'output'=>'lim',    'underover'=>TRUE],
                'Lim'        => ['input'=>'Lim',       'tag'=>'mo',     'output'=>'Lim',    'underover'=>TRUE],           // 2005-06-11 wes
                'sin'        => ['input'=>'sin',       'tag'=>'mo',     'output'=>'sin',    'unary'=>TRUE, 'func'=>TRUE],
                'cos'        => ['input'=>'cos',       'tag'=>'mo',     'output'=>'cos',    'unary'=>TRUE, 'func'=>TRUE],
                'tan'        => ['input'=>'tan',       'tag'=>'mo',     'output'=>'tan',    'unary'=>TRUE, 'func'=>TRUE],
                'arcsin'     => ['input'=>'arcsin',    'tag'=>'mo',     'output'=>'arcsin', 'unary'=>TRUE, 'func'=>TRUE], // 2006-09-07 DL
                'arccos'     => ['input'=>'arccos',    'tag'=>'mo',     'output'=>'arccos', 'unary'=>TRUE, 'func'=>TRUE], // 2006-09-07 DL
                'arctan'     => ['input'=>'arctan',    'tag'=>'mo',     'output'=>'arctan', 'unary'=>TRUE, 'func'=>TRUE], // 2006-09-07 DL
                'sinh'       => ['input'=>'sinh',      'tag'=>'mo',     'output'=>'sinh',   'unary'=>TRUE, 'func'=>TRUE],
                'cosh'       => ['input'=>'cosh',      'tag'=>'mo',     'output'=>'cosh',   'unary'=>TRUE, 'func'=>TRUE],
                'tanh'       => ['input'=>'tanh',      'tag'=>'mo',     'output'=>'tanh',   'unary'=>TRUE, 'func'=>TRUE],
                'cot'        => ['input'=>'cot',       'tag'=>'mo',     'output'=>'cot',    'unary'=>TRUE, 'func'=>TRUE],
                'sec'        => ['input'=>'sec',       'tag'=>'mo',     'output'=>'sec',    'unary'=>TRUE, 'func'=>TRUE],
                'csc'        => ['input'=>'csc',       'tag'=>'mo',     'output'=>'csc',    'unary'=>TRUE, 'func'=>TRUE],
                'coth'       => ['input'=>'coth',      'tag'=>'mo',     'output'=>'coth',   'unary'=>TRUE, 'func'=>TRUE],
                'sech'       => ['input'=>'sech',      'tag'=>'mo',     'output'=>'sech',   'unary'=>TRUE, 'func'=>TRUE],
                'csch'       => ['input'=>'csch',      'tag'=>'mo',     'output'=>'csch',   'unary'=>TRUE, 'func'=>TRUE],
                'log'        => ['input'=>'log',       'tag'=>'mo',     'output'=>'log',    'unary'=>TRUE, 'func'=>TRUE],
                'ln'         => ['input'=>'ln',        'tag'=>'mo',     'output'=>'ln',     'unary'=>TRUE, 'func'=>TRUE],
                'det'        => ['input'=>'det',       'tag'=>'mo',     'output'=>'det',    'unary'=>TRUE, 'func'=>TRUE],
                'dim'        => ['input'=>'dim',       'tag'=>'mo',     'output'=>'dim'],
                'mod'        => ['input'=>'mod',       'tag'=>'mo',     'output'=>'mod'],
                'gcd'        => ['input'=>'gcd',       'tag'=>'mo',     'output'=>'gcd',    'unary'=>TRUE, 'func'=>TRUE],
                'lcm'        => ['input'=>'lcm',       'tag'=>'mo',     'output'=>'lcm',    'unary'=>TRUE, 'func'=>TRUE],
                'lub'        => ['input'=>'lub',       'tag'=>'mo',     'output'=>'lub'],                                 // 2005-06-11 wes
                'glb'        => ['input'=>'glb',       'tag'=>'mo',     'output'=>'glb'],                                 // 2005-06-11 wes
                'min'        => ['input'=>'min',       'tag'=>'mo',     'output'=>'min',    'underover'=>TRUE],           // 2005-06-11 wes
                'max'        => ['input'=>'max',       'tag'=>'mo',     'output'=>'max',    'underover'=>TRUE],           // 2005-06-11 wes
                'f'          => ['input'=>'f',         'tag'=>'mi',     'output'=>'f',      'unary'=>TRUE, 'func'=>TRUE], // 2006-09-07 DL
                'g'          => ['input'=>'g',         'tag'=>'mi',     'output'=>'g',      'unary'=>TRUE, 'func'=>TRUE], // 2006-09-07 DL

                // Arrows
                'uarr'       => ['input'=>'uarr',      'tag'=>'mo',     'output'=>'&#' . hexdec('2191') . ';'],
                'darr'       => ['input'=>'darr',      'tag'=>'mo',     'output'=>'&#' . hexdec('2193') . ';'],
                'rarr'       => ['input'=>'rarr',      'tag'=>'mo',     'output'=>'&#' . hexdec('2192') . ';'],
                '->'         => ['input'=>'->',        'tag'=>'mo',     'output'=>'&#' . hexdec('2192') . ';'],
                '|->'        => ['input'=>'|->',       'tag'=>'mo',     'output'=>'&#' . hexdec('21A6') . ';'], // 2005-06-11 wes
                'larr'       => ['input'=>'larr',      'tag'=>'mo',     'output'=>'&#' . hexdec('2190') . ';'],
                'harr'       => ['input'=>'harr',      'tag'=>'mo',     'output'=>'&#' . hexdec('2194') . ';'],
                'rArr'       => ['input'=>'rArr',      'tag'=>'mo',     'output'=>'&#' . hexdec('21D2') . ';'],
                'lArr'       => ['input'=>'lArr',      'tag'=>'mo',     'output'=>'&#' . hexdec('21D0') . ';'],
                'hArr'       => ['input'=>'hArr',      'tag'=>'mo',     'output'=>'&#' . hexdec('21D4') . ';'],

                // Commands with argument
                'sqrt'       => ['input'=>'sqrt',      'tag'=>'msqrt',  'output'=>'sqrt',                      'unary'=>TRUE],
                'root'       => ['input'=>'root',      'tag'=>'mroot',  'output'=>'root',                      'binary'=>TRUE],
                'frac'       => ['input'=>'frac',      'tag'=>'mfrac',  'output'=>'/',                         'binary'=>TRUE],
                'stackrel'   => ['input'=>'stackrel',  'tag'=>'mover',  'output'=>'stackrel',                  'binary'=>TRUE], // 2005-06-05 wes
                '/'          => ['input'=>'/',         'tag'=>'mfrac',  'output'=>'/',                         'infix'=>TRUE],
                '_'          => ['input'=>'_',         'tag'=>'msub',   'output'=>'_',                         'infix'=>TRUE],
                '^'          => ['input'=>'^',         'tag'=>'msup',   'output'=>'^',                         'infix'=>TRUE],
                'hat'        => ['input'=>'hat',       'tag'=>'mover',  'output'=>'&#' . hexdec('005E') . ';', 'unary'=>TRUE, 'acc'=>TRUE],
                'bar'        => ['input'=>'bar',       'tag'=>'mover',  'output'=>'&#' . hexdec('00AF') . ';', 'unary'=>TRUE, 'acc'=>TRUE],
                'vec'        => ['input'=>'vec',       'tag'=>'mover',  'output'=>'&#' . hexdec('2192') . ';', 'unary'=>TRUE, 'acc'=>TRUE],
                'dot'        => ['input'=>'dot',       'tag'=>'mover',  'output'=>'.',                         'unary'=>TRUE, 'acc'=>TRUE],
                'ddot'       => ['input'=>'ddot',      'tag'=>'mover',  'output'=>'..',                        'unary'=>TRUE, 'acc'=>TRUE],
                'ul'         => ['input'=>'ul',        'tag'=>'munder', 'output'=>'&#' . hexdec('0332') . ';', 'unary'=>TRUE, 'acc'=>TRUE],
                'avec'       => ['input'=>'avec',      'tag'=>'munder', 'output'=>'~',                         'unary'=>TRUE, 'acc'=>TRUE],
                'text'       => ['input'=>'text',      'tag'=>'mtext',  'output'=>'text',                      'unary'=>TRUE],
                'mbox'       => ['input'=>'mbox',      'tag'=>'mtext',  'output'=>'mbox',                      'unary'=>TRUE],
                '"'          => ['input'=>'"',         'tag'=>'mtext',  'output'=>'mbox',                      'unary'=>TRUE],

                // Grouping brackets
                '('          => ['input'=>'(',         'tag'=>'mo',     'output'=>'(',                         'left_bracket'=>TRUE],
                ')'          => ['input'=>')',         'tag'=>'mo',     'output'=>')',                         'right_bracket'=>TRUE],
                '['          => ['input'=>'[',         'tag'=>'mo',     'output'=>'[',                         'left_bracket'=>TRUE],
                ']'          => ['input'=>']',         'tag'=>'mo',     'output'=>']',                         'right_bracket'=>TRUE],
                '{'          => ['input'=>'{',         'tag'=>'mo',     'output'=>'{',                         'left_bracket'=>TRUE],
                '}'          => ['input'=>'}',         'tag'=>'mo',     'output'=>'}',                         'right_bracket'=>TRUE],
                '(:'         => ['input'=>'(:',        'tag'=>'mo',     'output'=>'&#' . hexdec('2329') . ';', 'left_bracket'=>TRUE],
                ':)'         => ['input'=>':)',        'tag'=>'mo',     'output'=>'&#' . hexdec('232A') . ';', 'right_bracket'=>TRUE],
                '{:'         => ['input'=>'{:',        'tag'=>'mo',     'output'=>'{:',                        'left_bracket'=>TRUE,  'invisible'=>TRUE],
                ':}'         => ['input'=>':}',        'tag'=>'mo',     'output'=>':}',                        'right_bracket'=>TRUE ,'invisible'=>TRUE],
                '<<'         => ['input'=>'<<',        'tag'=>'mo',     'output'=>'&#' . hexdec('2329') . ';', 'left_bracket'=>TRUE], // 2005-06-07 wes
                '>>'         => ['input'=>'>>',        'tag'=>'mo',     'output'=>'&#' . hexdec('232A') . ';', 'right_bracket'=>TRUE] // 2005-06-07 wes
            ];
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

        $this->_node_arr = [];
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
        $node_arr = [];

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
                        $comma_pos_arr = [];

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
                            $tab_node_arr = [];

                            for ($i = 0;$i < $node_cnt;$i += 2) {
                                $tmp_key_node_arr = array_keys($node_arr);
                                if (!($tmp_node = $node_arr[$tmp_key_node_arr[0]])) {
                                    break;
                                }
                                $num_child = $tmp_node->getNumChild();
                                $k = 0;

                                $tmp_node->removeFirstChild();

                                $row_node_arr = [];
                                $row_frag_node_arr = [];

                                for ($j = 1;$j < ($num_child-1);$j++) {
                                    if (isset($comma_pos_arr[$i][$k]) &&
                                        $j == $comma_pos_arr[$i][$k]) {

                                        $tmp_node->removeFirstChild();

                                        $tmp_c_node = $this->createNode();
                                        $tmp_c_node->setName('mtd');
                                        $tmp_c_node->addChildArr($row_frag_node_arr);
                                        $row_frag_node_arr = [];

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
            $node_arr = [];

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
        $node = new MathMLNode($this->_node_cntr);
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
                return ['input'=>$sym_0, 'tag'=>'mn', 'output'=>$sym_0, 'symlen'=>$i];

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
            return ['input'=>$char, 'tag'=>$tag, 'output'=>$char, 'symlen'=>1];
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