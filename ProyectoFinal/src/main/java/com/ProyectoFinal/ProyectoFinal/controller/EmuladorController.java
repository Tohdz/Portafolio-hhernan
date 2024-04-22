
package com.ProyectoFinal.ProyectoFinal.controller;

import com.ProyectoFinal.ProyectoFinal.domain.Emulador;
import com.ProyectoFinal.ProyectoFinal.service.EmuladorService;
import com.ProyectoFinal.ProyectoFinal.service.impl.EmuladorServiceImpl;
import java.io.IOException;
import lombok.extern.slf4j.Slf4j;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.util.StringUtils;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.multipart.MultipartFile;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import org.springframework.core.io.ResourceLoader;
import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.core.io.Resource;

@Controller
@Slf4j
@RequestMapping("/emulador")

public class EmuladorController {
    @Autowired
    private EmuladorService emuladorService;

    @GetMapping("/emulist")
    public String inicio(Model model) {
        var emuladores = emuladorService.getEmuladores();
        model.addAttribute("Emuladores", emuladores);
        return "/emulador/emulist";
    }

    @GetMapping("/listado")
    public String inicio2(Model model) {
        var emuladores = emuladorService.getEmuladores();
        model.addAttribute("Emuladores", emuladores);
        return "/emulador/listado";
    }

    @GetMapping("/eliminar/{id}")
    public String emuEliminar(Emulador emulador) {
        emuladorService.delete(emulador);
        return "redirect:/emulador/listado";
    }

    @GetMapping("/modificar/{id}")
    public String emuModificar(Emulador emulador, Model model) {
        emulador = emuladorService.getEmulador(emulador);
        model.addAttribute("Emulador", emulador);
        return "/emulador/mods";
    }

    
    public EmuladorController(ResourceLoader resourceLoader) {
        this.resourceLoader = resourceLoader;
    }
    
    private static final String UPLOAD_DIR = "src/main/resources/static/images/emulators";

    private final ResourceLoader resourceLoader;
    
    @PostMapping("/guardar")
    public String EmuGuardar(@RequestParam String nombre, @RequestParam String consola, @RequestParam String year, @RequestParam String descripcion, @RequestParam String descarga, @RequestParam String imagen) throws IOException {
        Emulador emulador = new Emulador();
        emulador.setNombre(nombre);
        emulador.setConsola(consola);
        emulador.setYear(year);
        emulador.setDescripcion(descripcion);
        emulador.setDescarga(descarga);
        emulador.setImagen(imagen);  // Aquí asignamos la ruta relativa de la imagen
        emuladorService.save(emulador);
        return "redirect:/emulador/emulist";
    }
    @PostMapping("/guardar/{id}")
    public String EmuGuardar(@PathVariable String id, @RequestParam String nombre, @RequestParam String consola, @RequestParam String year, @RequestParam String descripcion, @RequestParam String descarga, @RequestParam String imagen) throws IOException {
        Emulador emulador = new Emulador();
        emulador.setId(Long.valueOf(id));
        emulador.setNombre(nombre);
        emulador.setConsola(consola);
        emulador.setYear(year);
        emulador.setDescripcion(descripcion);
        emulador.setDescarga(descarga);
        emulador.setImagen(imagen);  // Aquí asignamos la ruta relativa de la imagen
        emuladorService.save(emulador);
        return "redirect:/emulador/emulist";
    }
    
    /*@GetMapping("emulador/imagenes/{imageName}")
    public ResponseEntity<Resource> getImage(@PathVariable String imageName) {
        try {
            Resource fileResource = resourceLoader.getResource("classpath:static/templates/emulador/" + imageName);
            if (fileResource.exists()) {
                return ResponseEntity.ok()
                        .contentType(MediaType.IMAGE_PNG) // Cambia el tipo de media según el tipo de imagen que estés utilizando
                        .body(fileResource);
            } else {
                return ResponseEntity.notFound().build();
            }
        } catch (Exception e) {
            return ResponseEntity.notFound().build();
        }
    }
    */
}
