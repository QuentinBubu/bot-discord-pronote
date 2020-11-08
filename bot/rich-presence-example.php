static void UpdatePresence()
{
    DiscordRichPresence discordPresence;
    memset(&discordPresence, 0, sizeof(discordPresence));
    discordPresence.state = "Nombre de 0 mis:";
    discordPresence.details = "Joue à mettre des 0 à tous le monde";
    discordPresence.largeImageKey = "favicon1";
    discordPresence.largeImageText = "Pronote";
    discordPresence.smallImageKey = "pronote-not";
    discordPresence.smallImageText = "NOT";
    discordPresence.partyId = "0";
    discordPresence.partySize = 24;
    discordPresence.partyMax = 100;
    Discord_UpdatePresence(&discordPresence);
}