<?php
require '../vendor/autoload.php';


function formatComment($comment)
{
    $comment = trim(str_replace(['/**', '*/'], '', $comment));
    if (! $comment)
        $comment = "No documentation available.";
    else {
        $comment = str_replace('*', '', $comment);
        $comment = implode("\n", array_map(fn($line) => trim($line), explode("\n", $comment)));
        
        $comment = str_replace(['NULL', 'TRUE', 'FALSE'], ["`NULL`", "`TRUE`", "`FALSE`"], $comment);
        $comment = implode("\n\n", array_map(function($para) {
            if (str_contains(haystack:$para, needle:'[md-block]')) {
                $pos = strpos($para, '[md-block]');
                $nl = strpos($para, "\n", $pos+1);
    
                $start = $pos > 0 ? substr($para, 0, $pos) : '';
                $para = $start.substr($para, $nl);
            }
            else if (! str_contains(haystack:$para, needle:'-- parameters:'))
            {
                // standard paragraph
                if (! str_starts_with(trim($para), '```') and ! str_starts_with(trim($para), '>'))
                    $para = str_replace(["\n", "\t", "@return", "@throws", "@see"], [" ", " ", "**Returns:** ", "\n**Throws:** ", "\n**See:** "], $para);
            }
            else
            {
                // parameter/option listing
                $lines = explode("\n", $para);
                $filtered = [];
                foreach ($lines as $line) {
                    $line = trim($line);
                    if (! str_starts_with($line, '-- parameters:')) {
                        if (str_starts_with($line, '@param')) {
                            $line = '- **'.trim(substr($line, 7));
                            $line = str_replace("\t", " ", $line);
                            $line = substr_replace($line, '** ', strpos($line, ' ', 4), 1); 
                        }
                        else if ($line == '*')
                            $line = "";
                        else {
                            $line = str_replace(["----", "---", '--'], ["\t\t\t-", "\t\t-", "\t-"], $line);
                        }
                        if ($line)
                            $filtered[] = str_replace("\n", ' ', $line);
                    }
                }
                $para = implode("\n", $filtered);
            }
            return $para;
        }, explode("\n\n", $comment)));
    }
    return $comment;
}

function flattenComboTypes(array $types) {
    $out = [];
    foreach ($types as $t) {
        if ($t instanceof ReflectionUnionType || $t instanceof ReflectionIntersectionType) {
            array_push($out, flattenComboTypes($t->getTypes()));
        }
        else {
            $out[] = $t;
        }
    }
    return $out;
}


function genFunctions(string $fileName, array $methods)
{        
  $out = new SplFileObject(sprintf("%s/api/%s.md", __DIR__, $fileName), 'w+');
  $out->fwrite("------\n");
  $out->fwrite("### $fileName\n");

  $out->fwrite("#### Methods\n");
  foreach ($methods as $m) {
    $out->fwrite(sprintf("[%s](#%s)\n", $m, str_replace(' ', '-', strtolower($m))));
  }
  $out->fwrite("\n------\n");
    
  foreach ($methods as $m) {
    $method = new ReflectionFunction($m);
    $m_str = str_replace(subject:$m, search:'_', replace:'\_');
    $out->fwrite("##### {$m_str}\n");
    $out->fwrite("```php\n");
        
    $params = [];
    foreach ($method->getParameters() as $p) {
      $str = '';
      if ($type = $p->getType()) {
          if ($type instanceof ReflectionUnionType) {
              $names = implode('|', array_map(fn($t) => $t->getName(), flattenComboTypes($type->getTypes())));
              $str .= "$names ";
          }
          else {
              $str .= $type->getName()." ";
          }
      }
            
      if ($p->isVariadic()) {
        $str .= '...';
      }
            
      if ($p->isPassedByReference()) {
        $str .= '&$'.$p->getName();
      } else {
        $str .= '$'.$p->getName();
      }
      if ($p->isOptional() && $p->isDefaultValueAvailable()) {
        $def = $p->getDefaultValue();
                
        if (is_array($def)) {
          $def = '['.implode(', ', $def).']';
        } elseif (is_string($def)) {
          $def = sprintf("'%s'", str_replace(["\r", "\n"], ["\\r", "\\n"], $def));
        } elseif ($p->isDefaultValueConstant()) {
          $def = arrays::last(explode('\\', $p->getDefaultValueConstantName()));
        } elseif (is_null($def)) {
          $def = 'null';
        } elseif (is_bool($def)) {
          $def = $def ? 'true' : 'false';
        }
                
        $str .= " = $def";
      }
            
      $params[] = $str;
    }
    $params_str = implode(', ', $params);
    if ($rt = $method->getReturnType()) {
      $rt = ": $rt";
    }
    $out->fwrite("function {$m}($params_str) $rt\n");
    $out->fwrite("```\n");
        
    $out->fwrite(formatComment($method->getDocComment())."\n\n\n------\n");
  }
}

function main()
{
  genFunctions('strings', ['str_multipop', 'str_multishift', 'str_popex', 'str_shiftex', 'str_clean', 'is_stringable']);
  genFunctions('arrays', ['array_first', 'array_last', 'array_multipop', 'array_multishift', 'array_head', 'array_tail']);
  genFunctions('other', ['bool2str', 'constrain']);
}

main();
