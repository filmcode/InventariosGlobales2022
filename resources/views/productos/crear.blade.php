<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                    <div class="grid grid-cols-1">
                        <label for="linea" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Línea:</label>
                        <select id="linea" name="linea" style="border-color: rgb(37 99 235);" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2" type="text"required >
                            <option value="EDGE">EDGE</option>
                            <option value="ESCAPE">ESCAPE</option>
                            <option value="EXPEDITION">EXPEDITION</option>
                            <option value="EXPLORER">EXPLORER</option>
                            <option value="BRONCO_Sport">BRONCO Sport</option>
                            <option value="BRONCO">BRONCO</option>
                            <option value="TERRITORY">TERRITORY</option>
                            <option value="F150">F150</option>
                            <option value="F250">F250</option>
                            <option value="F350">F350</option>
                            <option value="F450">F450</option>
                            <option value="F550">F550</option>
                            <option value="LOBO">LOBO</option>
                            <option value="MUSTANG">MUSTANG</option>
                            <option value="MAVERICK">MAVERICK</option>
                            <option value="RANGER_SA">RANGER SA</option>
                            <option value="RANGER_SAF">RANGER SAF</option>
                            <option value="TRANSIT_COURIER">TRANSIT COURIER</option>
                            <option value="TRANSIT_CUSTOM">TRANSIT CUSTOM</option>
                            <option value="TRANSIT_NA">TRANSIT NA</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-1">
                        <label for="intercambio" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Intercambio:</label>
                        <select id="intercambio" name="intercambio" style="border-color: rgb(37 99 235);" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2" type="text" >
                            <option value=" "> </option>
                            <option value="EDGE">EDGE</option>
                            <option value="ESCAPE">ESCAPE</option>
                            <option value="EXPEDITION">EXPEDITION</option>
                            <option value="EXPLORER">EXPLORER</option>
                            <option value="BRONCO_Sport">BRONCO Sport</option>
                            <option value="BRONCO">BRONCO</option>
                            <option value="TERRITORY">TERRITORY</option>
                            <option value="F150">F150</option>
                            <option value="F250">F250</option>
                            <option value="F350">F350</option>
                            <option value="F450">F450</option>
                            <option value="F550">F550</option>
                            <option value="LOBO">LOBO</option>
                            <option value="MUSTANG">MUSTANG</option>
                            <option value="MAVERICK">MAVERICK</option>
                            <option value="RANGER_SA">RANGER SA</option>
                            <option value="RANGER_SAF">RANGER SAF</option>
                            <option value="TRANSIT_COURIER">TRANSIT COURIER</option>
                            <option value="TRANSIT_CUSTOM">TRANSIT CUSTOM</option>
                            <option value="TRANSIT_NA">TRANSIT NA</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-1">  
                        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Catálogo:</label>
                        <input name="catalogo" style="border-color: rgb(37 99 235);" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2" type="text" required/>
                    </div>
                    <div class="grid grid-cols-1">
                        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Modelo:</label>
                        <input name="modelo" style="border-color: rgb(37 99 235);" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2" type="text" required/>
                    </div>
                    <div class="grid grid-cols-1">
                        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Serie:</label>
                        <input name="serie" style="border-color: rgb(37 99 235);" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2" type="text" required/>
                    </div>
                    <div class="grid grid-cols-1">
                        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Color:</label>
                        <input name="color" style="border-color: rgb(37 99 235);" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2" type="text" required/>
                    </div>
                    <div class="grid grid-cols-1">
                        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Ubicación:</label>
                        <input name="ubicacion" style="border-color: rgb(37 99 235);" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2" type="text" required/>
                    </div>
                    <div class="grid grid-cols-1">
                        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Costo:</label>
                        <input name="costo" style="border-color: rgb(37 99 235);" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2" type="text" required/>
                    </div>
                    <div class="grid grid-cols-1">
                        <label class="md:text-sm text-xs text-gray-500 text-light font-semibold">Para <span style="color: #2563EB; font-weight: bold;">PERSONA MORAL</span>, es necesario adjuntar los siguientes documentos:</label>
                        <p>i.Pedido completo <br>
                           ii.Orden de Compra, si aplica <br>
                           iii.$ 100,000.00 de apartado, si aplica <br>
                           iv.Cedula de identificación fiscal <br>
                           v.INE de apoderado</p>
                    </div>
                    <div class="grid grid-cols-1">
                        <label class="md:text-sm text-xs text-gray-500 text-light font-semibold">Para <span style="color: #2563EB; font-weight: bold;">PERSONA FISICA</span>, Es necesario adjuntar los siguientes documentos:</label>
                        <p>i.Pedido completo <br>
                           ii.$100,000.00 de apartado si es de contado <br>
                           iii.Aprobación de crédito y enganche si es financiamiento <br>
                           iv.INE <br>
                    </div>
                    <div class="grid grid-cols-1" style="display:none">
                        <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Apartado:</label>
                        <input name="apartado" style="border-color: rgb(37 99 235);" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2" type="text"/>
                    </div>
                    <div class="grid grid-cols-1" style="display:none">
                        <label for="estatus" style="border-color: rgb(37 99 235);" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Estatus</label>
                        <select id="estatus" name="estatus" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2" type="text">
                            <option value="Pendiente">PENDIENTE</option>
                            <option value="Buscando">BUSCANDO</option>
                            <option value="Encontrado">ENCONTRADO</option>
                            <option value="Incompleta">INCOMPLETA</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-1" style="display:none">
                        <label style="border-color: rgb(37 99 235);" class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Observaciónes:</label>
                        <input name="observaciones" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2" type="text"/>
                    </div>
                </div>

                
                <div class="grid grid-cols-1 mt-5 mx-7" id="imagePreview"></div>
                <!-- modal -->
                <div class="modal modal--close" id="modal">
                    <div class="modal__btn" id="modalBtn">×</div>
                     <div class="slider">
                         <div class="slider__content" id="sliderContent"></div>
                        <div class="slider__btn slider__btn--left" id="sliderButtonLeft">&#60;</div>
                        <div class="slider__btn slider__btn--right" id="sliderButtonRight">&#62;</div>
                     </div>
                </div>
                <div class="grid grid-cols-1 mt-5 mx-7">
                <label class="uppercase md:text-sm text-xs text-black-500 text-light font-semibold mb-1">Subir evidencias:</label>
                    <div class='flex items-center justify-center w-full'>
                        <label style="border-color: rgb(37 99 235);" class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-blue-100 hover:border-blue-300 group'>
                            <div class='flex flex-col items-center justify-center pt-7'>
                            <svg class="w-10 h-10 text-blue-400 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class='text-sm text-blue-400 group-hover:text-blue-600 pt-1 tracking-wider'>Seleccione los documentos</p>
                            </div>
                        <input name="files[]" id="imagen" type='file' multiple="true" class="hidden" />
                        </label>
                    </div>
                </div>

                <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                    <a href="{{ route('productos.index') }}" class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancelar</a>
                    <button type="submit" class='w-auto bg-blue-500 hover:bg-blue-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Guardar</button>
                </div>
            </form> 
            </div>
        </div>
    </div>
</x-app-layout>
<script src="/js/previewImages.js"></script>
