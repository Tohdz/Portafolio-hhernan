package com.ProyectoFinal.ProyectoFinal.controller;

import com.ProyectoFinal.ProyectoFinal.domain.Game;
import lombok.extern.slf4j.Slf4j;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.PathVariable;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.List;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.multipart.MultipartFile;
import com.ProyectoFinal.ProyectoFinal.service.GameService;

@Controller
@Slf4j
@RequestMapping("/")
public class GameController {

    @Autowired
    private GameService gameService;
    
    @GetMapping("/games")
    public String games(@RequestParam(value = "s", required = false) String search, Model model) {
        List<Game> games;
        if (search != null && !search.isEmpty()) {
            games = gameService.getGamesByNameContaining(search);
        }
        else {
            games = gameService.getGames();
        }
        
        
        model.addAttribute("games", games);
        return "/games";
    }
    
    @GetMapping("/games/{id}")
    public String play(Model model, @PathVariable("id") String id) {
        try {
            var game = gameService.getGame(Long.parseLong(id));
            if (game == null) return "redirect:/404";
            model.addAttribute("game", game);
            return "/play";
        }
        catch (Exception e) {
            return "redirect:/404";
        }
    }
    
    private static final String UPLOAD_DIR = "src/main/resources/static";
    
    @PostMapping("/games/{id}/modificar")
    public String gameModificar(@PathVariable("id") String id, @RequestParam String titulo, @RequestParam String anno, @RequestParam String descripcion, @RequestParam("imagen") MultipartFile imagen) throws IOException {
        if (imagen.getSize() != 0) {
            Path path = Paths.get(UPLOAD_DIR + "/images/games/" + id);
            Files.write(path, imagen.getBytes());
        }
        Game game = gameService.getGame(Long.parseLong(id));
        game.setName(titulo);
        game.setYear(Integer.parseInt(anno));
        game.setDescription(descripcion);

        gameService.save(game);
        
        return "redirect:/games/" + id;
    }
    
    @GetMapping("/games/{id}/eliminar")
    public String gameEliminar(@PathVariable("id") String id) {
        Game game = gameService.getGame(Long.parseLong(id));
        try {
            Files.delete(Paths.get(UPLOAD_DIR + "/roms/" + game.getEmulator() + "/" + game.getId() + "." + game.getExtension()));
        }
        catch (Exception e) {
            System.out.println("ROM NOT FOUND: " + e.getMessage());
        }        
        try {
            Files.delete(Paths.get(UPLOAD_DIR + "/images/games/" + game.getId()));
        }
        catch (Exception e) {
            System.out.println("GAME IMAGE NOT FOUND: " + e.getMessage());
        }
        gameService.delete(game);
        return "redirect:/games";
    }
    
    @PostMapping("/games/agregar")
    public String gameNuevo(@RequestParam String titulo, @RequestParam String anno, @RequestParam String descripcion, @RequestParam String emulador, @RequestParam("rom") MultipartFile rom, @RequestParam("imagen") MultipartFile imagen) throws IOException {
        
        Game game = new Game();
        game.setName(titulo);
        game.setYear(Integer.parseInt(anno));
        game.setDescription(descripcion);
        game.setExtension(rom.getOriginalFilename().split("\\.")[rom.getOriginalFilename().split("\\.").length-1]);
        
        if (emulador.contains("-")) {
            game.setEmulator(emulador.split("-")[0]);
            switch (emulador.split("-")[1]) {
                case "J":
                    game.setBios("scph5500.bin");
                    break;
                case "E":
                    game.setBios("scph5502.bin");
                    break;
                case "A":
                    game.setBios("scph5501.bin");
                    break;
            }
        }
        else game.setEmulator(emulador);
        game = gameService.save(game);
        
        Files.createDirectories(Paths.get(UPLOAD_DIR + "/roms/" + game.getEmulator()));
        Path path = Paths.get(UPLOAD_DIR + "/roms/" + game.getEmulator() + "/" + game.getId() + "." + game.getExtension());
        Files.write(path, rom.getBytes());
        
        Files.createDirectories(Paths.get(UPLOAD_DIR + "/images/games/" + game.getId()));
        path = Paths.get(UPLOAD_DIR + "/images/games/" + game.getId());
        Files.write(path, imagen.getBytes());
        
        return "redirect:/games";
    }
}