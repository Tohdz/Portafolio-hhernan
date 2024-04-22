package com.ProyectoFinal.ProyectoFinal.controller;

import com.ProyectoFinal.ProyectoFinal.domain.Tutorial;
import com.ProyectoFinal.ProyectoFinal.service.TutorialService;
import java.util.UUID;
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
@RequestMapping("/tutorial")
public class TutorialesController {

    @Autowired
    private TutorialService tutorialService;

    @GetMapping("/Tutolist")
    public String inicio(Model model) {
        var tutoriales = tutorialService.getTutoriales();
        model.addAttribute("tutoriales", tutoriales);
        return "/tutorial/Tutolist";
    }

    @GetMapping("/listado")
    public String inicio2(Model model) {
        var tutoriales = tutorialService.getTutoriales();
        model.addAttribute("tutoriales", tutoriales);
        return "/tutorial/listado";
    }

    @GetMapping("/eliminar/{id}")
    public String tutoEliminar(Tutorial tutorial) {
        tutorialService.delete(tutorial);
        return "redirect:/tutorial/listado";
    }

    @GetMapping("/modificar/{id}")
    public String tutoModificar(Tutorial tutorial, Model model) {
        tutorial = tutorialService.getTutorial(tutorial);
        model.addAttribute("tutorial", tutorial);
        return "/tutorial/mods";
    }

    private static final String UPLOAD_DIR = "src/main/resources/static/images/subidas";

    private final ResourceLoader resourceLoader;

    public TutorialesController(ResourceLoader resourceLoader) {
        this.resourceLoader = resourceLoader;
    }

    @PostMapping("/guardar")
    public String tutoGuardar(@RequestParam String titulo, @RequestParam String cuerpo, @RequestParam("imagen") MultipartFile file) throws IOException {
        String fileName = StringUtils.cleanPath(file.getOriginalFilename());
        Path path = Paths.get(UPLOAD_DIR + "/" + fileName);
        Files.write(path, file.getBytes());

        Tutorial tutorial = new Tutorial();
        tutorial.setImagen("images/subidas/" + fileName);  // Aquí asignamos la ruta relativa de la imagen
        tutorial.setTitulo(titulo);
        tutorial.setCuerpo(cuerpo);
        tutorialService.save(tutorial);

        return "redirect:/tutorial/Tutolist";
    }

    @PostMapping("/guardar2/{id}")
    public String tutoGuardar(@PathVariable String id,@RequestParam String titulo,@RequestParam String cuerpo,@RequestParam("imagen") MultipartFile file) throws IOException {
        String fileName = StringUtils.cleanPath(file.getOriginalFilename());
        Path path = Paths.get(UPLOAD_DIR + "/" + fileName);
        Files.write(path, file.getBytes());

        Tutorial tutorial = new Tutorial();
        tutorial.setId(Long.valueOf(id)); // Establecer el ID del tutorial
        tutorial.setImagen("images/subidas/" + fileName); // Asignamos la ruta relativa de la imagen
        tutorial.setTitulo(titulo);
        tutorial.setCuerpo(cuerpo);

        tutorialService.save(tutorial); // Guardar el tutorial con la nueva imagen

        return "redirect:/tutorial/Tutolist";
    }

    @GetMapping("/images/subidas/{imageName:.+}")
    public ResponseEntity<Resource> getImage(@PathVariable String imageName) {
        try {
            Resource fileResource = resourceLoader.getResource("classpath:static/" + imageName);
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
}
