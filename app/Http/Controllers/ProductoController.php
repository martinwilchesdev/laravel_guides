<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request) {
        // obtener el valor de perPage pasado en la request desde el formulario, si no hay usar 5 por defecto
        $perPage = $request->input('perPage', 5);

        // iniciar la consulta (retorna la consulta basica para obtener todos los productos de la base de datos `select * from productos`)
        $query = Producto::query();

        // aplicar la busqueda si se proporciona un termino
        if ($request->filled('search')) {
            // filtra los productos cuyo nombre, precio o descripcion contenga el termino de busqueda
            $query->where('nombre', 'like' , '%' . $request->search . '%')
                ->orWhere('precio', 'like', '%' . $request->search . '%')
                ->orWhere('descripcion', 'like', '%' . $request->search . '%');
        }

        // `appends($request->query())` mantiene los filtros activos al cambiar de pagina.
        // en este caso al poginar se mantiene en la URL en termino de busqueda aplicado
        $productos = $query->paginate($perPage)->appends($request->query()); // obtener la cantidad de productos a mostrar por pagina

        return view('productos.index', compact('productos', 'perPage')); // los productos obtenidos son pasados a la vista `productos.index`
        /**
         * `compact('productos')` crea un array asociativo donde el nombre de la variable es la clave y su valor es el contenido de `$productos`
         * o lo que es lo mismo a escribir `return view('productos.index', ['productos' => $productos])`.
         *
         * se retorna el valor de `$perPage` para asegurar que se mantenga en la URL al cambiar de pagina.
        */
    }

    // devuelve la vista con el formulario para crear un nuevo producto
    public function create() {
        return view('productos.create');
    }

    // valida los datos y guarda el producto en la base de datos
    public function store(Request $request) {
        // validar los datos recibidos desde el formulario
        $request->validate([
            'nombre' => 'required|string|max:255', // es requerido, debe ser una cadena de texto y maximo debe tener 255 caracteres
            'precio' => 'required|numeric|min:0', // es requerido, debe ser numerico y minimo debe tener un valor de 0
            'descripcion' => 'nullable|string' // puede ser null y debe ser una cadena de texto
        ]);

        // crear el producto
        Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion
        ]);

        // redirigir a la .ruta `/productos` utilizando el `name` definido para la ruta con un mensaje de exito
        return redirect()->route('productos.index')->with('success', 'Producto agregado correctamente');
    }

    // mostrar el formulario de edicion
    public function edit($id) {
        $producto = Producto::findOrFail($id); // busca el producto en la base de datos, si no se encuentra muestra error 404
        return view('productos.edit', compact('producto'));
    }

    // actualizar un producto en la base de datos
    // recibe como paramretros el objeto de la request y el id del producto a actualizar
    public function update(Request $request, $id) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string'
        ]);

        // se busca el producto que se va a actualizar
        $producto = Producto::findOrFail($id);
        $producto->update($request->all()); // actualiza el producto con los valores enviados

        // redirigir a la ruta `/productos` utilizando el `name` definido para la ruta con un mensaje de exito
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    // eliminar un producto en la base de datos
    public function destroy($id) {
        // se busca el producto que se va a actualizar
        $produto = Producto::findOrFail($id);
        $produto->delete(); // se elimina el producto

        // redirigir a la ruta `/productos` utilizando el `name` definido para la ruta con un mensaje de exito
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }
}
