class Conexion{
    protected static $conexion;

    public function __construct(){
        if(self::$conexion==null){
            self::conexion();
        }
    }

    public static function conexion(){
        //leer parametros de config y guardarlo en su atributo correspondiente
        $param = parse_ini_file('../.config');
        $base=$param["bbdd"];
        $usuario=$param["usuario"];
        $pass=$param["pass"];
        $host=$param["host"];
        //descriptor servidor con los parametros
        $dns="mysql:host=$host;dbname=$base;charst=utf8mb4";
        //intento de conexion
        try{
            //pdo (dns, usuario, contraseña)
            self::$conexion=new PDO($dns, $usuario, $pass);
            //depuracion de errores
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //si falla la conexion
        }catch(PDOException $ex){
            die("Error de conexion: ".$ex->getMessage());
        }
    }
}